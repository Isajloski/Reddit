
# Redbot

Проектот „Redbot“ преставува редизајн и „груба“ реимплементација на постоечкиот Reddit. Изработена е демо верзија која опфаќа сфери од предметите „Имлементација на системи со слободен и отворен код“ и “Напреден веб дизајн’.




## Сетапирање на околина

За да се осигурате дека успешно ви е поставен проектот и сите зависности изврешете ги следните команди во тековниот репозиториум:

```bash
  npm install
  composer install
```
    
## Стартување на проект

За успешно подигање на front-end и back-end апликациите извршете ги следните команди во тековниот репозиториум.

```bash
 php artisan serve
 npm run dev
```


## API Reference

#### Преглед на објави на заедници кои ги следи корисникот

```http
  POST /posts/following/paginate
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `pageNumber` | `number` | **Required**. Моменталната страница |

Во телото се праќа sortDto објект кој го содржи типот на сортирање:
{
    sort : type
}

кој може да биде 'new' или 'trending'. Во зависност од тој тип се прави сортирање на објавите.

Враќа листа од postDto {
    int id, 
    string title, 
    string body, 
    CommunityDto community, 
    UserDto user, 
    bool | null vote, 
    int karma, 
    int comments_number, 
    string date, 
    Flair | null flair
}

#### Преглед на најпопуларни објави од сите заедници

```http
  POST /posts/trending/paginate
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `pageNumber`      | `number` | **Required**. Моменталната страница |

Во телото се праќа sortDto објект кој го содржи типот на сортирање:
{
    sort : type
}

кој може да биде 'new' или 'trending'. Во зависност од тој тип се прави сортирање на објавите.

Враќа листа од postDto {
    int id, 
    string title, 
    string body, 
    CommunityDto community, 
    UserDto user, 
    bool | null vote, 
    int karma, 
    int comments_number, 
    string date, 
    Flair | null flair
}

#### Преглед на заедница

```http
  GET /community/${id}/card
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на постоечка заедница |

Враќа communityCardDto {
    int id, 
    string name, 
    string about, 
    string rules, 
    int activeUsers,  
    int totalUsers, 
    array flairs
}

#### Листање на заедници кои ги следи корисникот

```http
  GET /community/user/following
```


#### Листање на објави од заедница

```http
  GET /community/${id}/paginate
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на постоечка заедница |
| `pageNumber`      | `number` | **Required**. Моменталната страница |

Враќа листа од postDto {
    int id, 
    string title, 
    string body, 
    CommunityDto community, 
    UserDto user, 
    bool | null vote, 
    int karma, 
    int comments_number, 
    string date, 
    Flair | null flair
}

#### Креирање на заедница

```http
  POST /community/сreate
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` | **Required**. Името на заедницата |
| `description`      | `string` | **Required**. Опис на заедницата |
| `image`      | `file` | Слика на заедницата |
| `rules`      | `string` | Правила на заедницата |
| `flairs`      | `array` | Категории на заедницата |

#### Едитирање на заедница

```http
  POST /community/${id}/edit
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на заедницата |
| `name`      | `string` | **Required**. Името на заедницата |
| `description`      | `string` | **Required**. Опис на заедницата |
| `image`      | `file` | Слика на заедницата |
| `rules`      | `string` | Правила на заедницата |
| `flairs`      | `array` | Категории на заедницата |


#### Бришење на заедница

```http
  POST /community/${id}/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на заедницата |

Ја брише заедницата.


#### Креирање на објава

```http
  POST /post/create
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `title`      | `string` | **Required**. Наслов на објавата |
| `body`      | `string` | **Required**. Тело на објавата |
| `communityId`      | `number` | **Required**. ID-то на заедницата во која се објавува |
| `image`      | `file` | Слика на објавата |
| `flair`      | `number` | ID-то на категоријата |

#### Едитирање на објава

```http
  POST /post/{id}/edit
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на објавата |
| `title`      | `string` | **Required**. Наслов на објавата |
| `body`      | `string` | **Required**. Тело на објавата |
| `communityId`      | `number` | **Required**. ID-то на заедницата во која се објавува |
| `image`      | `file` | Слика на објавата |
| `flair`      | `number` | ID-то на категоријата |


#### Бришење на објава

```http
  DELETE /post/{id}/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на објавата |

#### Гласање на објава

```http
  POST /post/${id}/vote
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на објавата |

Во телото се праќа Votedto {
                id: number,
                vote: 1 | 0
            }

Се враќа новата карма на објавата на која се гласа.


#### Бришење на глас на објавата

```http
  DELETE /post/${id}/vote/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на објавата |


Се враќа новата карма на објавата на која се брише гласот.

#### Листање на категории на заедницата

```http
  GET /flair/community/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на заедницата |


#### Креирање на коментар

```http
  POST /comment/create
```
Се праќа во телото commentCreationDto = {
                post_id: number | null,
                parent_comment_id: number | null,
                body: string
            }

Враќа commentDto { int id, 
    int | null parent_comment_id, 
    UserDto user, 
    int | null post_id, 
    string body,
    int karma,
    string date,
    int | null replies,
    bool | null vote }

#### Едитирање на коментар

```http
  POST /comment/${id}/edit
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на коментарот |


Во телото се праќа commentUpdateDto {id: number, body: string}

Враќа commentDto { int id, 
    int | null parent_comment_id, 
    UserDto user, 
    int | null post_id, 
    string body,
    int karma,
    string date,
    int | null replies,
    bool | null vote }

#### Бришење на коментар

```http
  DELETE /comment/${id}/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на коментарот |


#### Гласање на коментар

```http
  POST /comment/${id}/vote
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на коментарот |

Се праќа во телото voteDto = {
                id: number,
                vote:  1 | 0
            }

Ја враќа новата карма на коментарот.

#### Бришење на глас на коментар

```http
  DELETE /comment/${id}/vote/delete
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на коментарот |


Ја враќа новата карма на коментарот.

#### Листање на коментари на објавата

```http
  GET /post/${id}/comments
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на објавата |

Враќа листа од commentDto { int id, 
    int | null parent_comment_id, 
    UserDto user, 
    int | null post_id, 
    string body,
    int karma,
    string date,
    int | null replies,
    bool | null vote }

#### Листање на реплики на коментарите

```http
  GET /comment/${id}/replies
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `number` | **Required**. ID-то на коментарот |

Враќа листа од commentDto { int id, 
    int | null parent_comment_id, 
    UserDto user, 
    int | null post_id, 
    string body,
    int karma,
    string date,
    int | null replies,
    bool | null vote }




