<?php

namespace App\Http\Controllers;

use App\Mappers\CommunityMapper;
use App\Mappers\PostMapper;
use App\Models\Community\Community;
use App\Models\Flair\Flair;
use App\Services\CommunityService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class CommunityController extends Controller
{

    public function __construct(private readonly CommunityService $communityService,
                                private readonly CommunityMapper $communityMapper,
                                private readonly PostMapper $postMapper,
                                private readonly PostService $postService){}


    public function createEditForm()
    {
        return Inertia::render('Communities/CommunityForm');
    }


    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|unique:communities',
            'description' => 'required',
            'rules' => 'required',
            'image' => 'nullable|file',
            'flairs' => 'nullable|array'
        ]);

        $user = Auth::user();
        $community = new Community();
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageController = new ImageController();
            $imageId = $imageController->storeImage($file, '/communities');
            $community->image_id = $imageId;
        }
        else{
            $community->image_id = null;
        }

        $community->user()->associate($user);
        $community->save();
        $communityId = $community->id;

        if ($request->has('flairs') && is_array($request->input('flairs'))) {
            $flairs = $request->input('flairs');

            foreach ($flairs as $flairName) {
                $flair = new Flair();
                $flair->name = $flairName;
                $flair->community_id = $community->id;
                $flair->save();
            }
        }

        return redirect('/community/'.$communityId);
    }


    public function edit($id)
    {
        $community = Community::find($id);
    }

    public function update($id, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'rules' => 'required',
        ]);

        $community = Community::findOrFail($id);
        $community->name = $request->input('name');
        $community->description = $request->input('description');
        $community->rules = $request->input('rules');

        $community->save();

        return redirect()->route('communities.index');
    }



    public function destroy($id)
    {
        $community = Community::findOrFail($id);

        if ($community->image) {
            $imageId = $community->image_id;
        }


        $community->delete();

        if($community->image_id != null) {
            $imageController = new ImageController();
            $imageController->delete($imageId);
        }

        return redirect()->route('communities.index');
    }

    public function renderById($id): \Illuminate\Http\JsonResponse|\Inertia\Response
    {
        $community = Community::with('user', 'flairs', 'image')->find($id);

        if (!$community) {
            return response()->json(['message' => 'Community not found'], 404);
        }

        return Inertia::render('Community', [
            'community' => [$community],
        ]);
    }

    public function getCard($id)
    {
        return $this->communityService->getCommunityCard($id);

    }

    public function userCommunities()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        return $this->communityMapper->mapCollectionToDto($this->communityService->getUserCommunities($user));
    }


    public function paginateCommunityPosts($id, Request $request){

        $community = Community::find($id);

        $jsonData = json_decode($request->getContent(), true);

        $sortBy = $jsonData['sort'];

        if($sortBy=="new"){
            $posts = $this->postService->getCommunityPosts($community)->orderBy('created_at', 'desc')->paginate(2);
        }

        else{

                $posts = DB::table('posts')
                    ->leftJoin('post_votes', 'posts.id', '=', 'post_votes.post_id')
                    ->select('posts.*', DB::raw('SUM(CASE WHEN post_votes.vote = 1 THEN 1 ELSE 0 END) as karma'))
                    ->where('posts.community_id', $id)
                    ->groupBy('posts.id')
                    ->orderByDesc('karma')
                    ->paginate(2);
        }



        $updatedPosts = $posts->getCollection()->map(function($post) {
            $postGet = \App\Models\Post\Post::query()
                ->where('id','=', $post->id)
                ->first();
            return
                $this->postMapper->mapToDto($postGet)
            ;
        });


        $posts->setCollection($updatedPosts);

        return $posts;
    }

    public function rules($id){
        return $this->communityService->getCommunityRules($id);
    }

    public function description($id){
        return $this->communityService->getCommunityDescription($id);
    }

}
