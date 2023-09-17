# 1. Вовед

RedBot претставува форум портал испириран од Reddit и Quora. Има за цел да креира простор во кој корисниците ќе можат да разменуваат информации и да комуницираат помеѓу себe. 

RedBot претставува апликација која ќе го олесни начинот на комуникација и размена на информации. Апликацијата ќе биде достапна на сите корисници и истите ќе имаат пристап до информациите во зависност од нивото за кое се авторизирани. Корисниците ќе имаат опција за создавање на нови заедници, со свои правила и тема. Корисниците ќе имаат опција за да креираат нови објави во некои од заедниците. Секој корисник ќе може да објавува објави и да коментира на други постови, исто така корисникот ќе може да лајкнува и дислајкнува постови и коментари. Со едноставен и лесен кориснички интерфејс се гарантира успешноста за користење на нашата апликација. 

Следните секции ќе пробаат да ги објаснат сите фунцкионалности на RedBot, како може да правите промени, како може да го користите кодот и што ви е потребно за истото.

# 2. Функционални и нефунцкионални барања

## 2.1 Функционални барањња

### Корисник
- Регистрација на корисник
- Пријава на корисник
- Уредување на корисничките информации
- Следење на community
- Преглед на сите објави во едно community или на home page.
- Преглед на сите коментари. 
- Креирање на пост за одредено community
  - Додавање на пост
  - Бришење на пост
  - Ажурирање на пост 
- Коментирање на објави
  - Додавање на пост
  - Бришење на пост
  - Ажурирање на пост 
- Преглед на сите објави и коментари

### Модератор
- Ажурирање на communitiy 
- Бришење на community
- Бришење на други објави од други корисници.
- Бришење на коментари од други корисници.

## 2.2 Нефункциски барања

### Барања за перформанси
- Системот треба да поддржува 50000 + корисници во даден момент.
- Содржината на страните на системот мора да се вчита за најмногу 3 секунди.
- Системот мора да поддржува скалабилност.
- Системот треба да биде компатибилен со други системи.
- Базата на податоци на системот треба да има минимална големина од 100TB.
- Кога системот ќе биде под тежок товар, времето на одговор не смее да биде повеќе од 5
секунди.
- При пад на системот, тој мора да биде онлајн за помалку од 40 минути.

### Барања за безбедност и приватност

- Мрежниот сообраќај да се одвива преку HTTPS.
- Користење на безбедни бази за чување на податоците и соодветен backup на податоците на друга локација.
- При најава на самиот систем да се валидира корисникот преку соодветниот е-маил внесен
при извршената регистрација на корисникот.
- Системот треба да е доверлив при DOS напади.
- При прикачување на некаква содржина од страна на студентот, системот мора да обезбеди
интегритет на тие податоци.
- За секое прикачување или ажурирање на постоечката содржина, корисникот мора да се
логира на системот.
- При обид за најавување на туѓа корисничка сметка, системот треба да ја блокира таа сметка.
- Заштита на лозинката и личните податоци на корисникот, како и пораките испратени кон
останатите корисници.

### Барање за Кориснички Интерфејс
- Корисничкиот интерфејс треба да биде интуитивен и лесен за користење за сите видови на корисници.
- Системот треба да биде брз и одзивен на сите видови на уреди, вклучително мобилни телефони и таблети.
- Поддршка за Мобилни Уреди: Системот треба да се прилагоди и биде функционален на различни мобилни оперативни системи.
- Поддршка за Различни Јазици: Системот треба да обезбеди поддршка за различни јазици, вклучително поддршка за Unicode.
- Локални Формати на Датуми и Време: Прикажувањето на датуми и време кои ќе се прилагодат, врз основа на моменталната локација на коринисникот.


# 3. Дизајн
За целосна реимплементација направен е и редизајн на корисничкиот интерфејс.
Целта е да се намали комплексноста, да изгледа модерно и атрактивно, истовремено и едноставно.

## 3.1 Редизајн на лого

![Redbot logo](https://i.ibb.co/GCV7hLZ/redbot-horizontal-01-1.png)
Логото е директно инспирирано од моменталното лого на редит, и е симплифицирана илустрација на робот со цел да се задржи тековниот бренд и идентитет на редит.

## 3.2 Редизајн на страници
![Home Page](https://i.ibb.co/rmCHDBH/homepage.png)
Страната е поделена во три секции, каде што објавите се листаат во средина за да го задржат целосниот фокус, додека пак левата и десната страна служат за додатни функционалности како филтрирање и правење акции.
На секоја објава има можност да се види авторот, која е заедницата, содржината на објавата, датум, како и број на интеракции.

[Figma project](https://www.figma.com/file/Zy4PBjqQ4Kqmmd3VMhMfGc/Reddit?type=design&node-id=0%3A1&mode=design&t=67Rht0nqNYy1Aq9F-1)



# 4. Технологии 

При развој на RedBot, ние избравме стак од модерни и ефикасни технологии кои ни овозможуваат голем број на функионалности, подобри перформанси и поубави визуелни ефекти. Подоле, ќе ги опишеме овие технологии и нивните карактеиристики.

## 4.1 Laravel

Laravel е моќен и широко користен PHP веб фрејмворк познат по неговата елегантна синтакса. Laravel како архитектура ја користи MVC (Mode View Controller), со која ни се поедноставува логиката на самата апликација.

Laravel's ORM (Object-Relational Mapping) provides an intuitive way to interact with databases, reducing the complexity of SQL queries.
Eloquent simplifies database operations and allows developers to work with database records as PHP objects.

### Карактеристики на Laravel:
- Eloquent ORM
    - ORM или Object-Relational Mapping ни овозможува лесна и ефикасна работа со податочни бази, исто така ја намалува комплексноста на SQL прашалниците.
    - Eloquent му овозможува на корисникот да работи со податоци од податочната база како готови PHP објекти, со што многу се олеснува развојот на софтвер. 
- Artisan CLI
    - Artisian е command line interface кој се користи при работа со датабази, генерирање на готови класи и методи во соодветни фолдери. 
- Authentication and Authorization
    - Laravel веќе има имплементирано Автентикација и авторизизација, исто така овозможува контрола на рутите преку некакви улоги.
    - Со пишување на една линија код во Artiain CLI корисникот ќе има веќе готова авторизација и автентикација, која пдоцоцна може да ја прошири, во зависност од потребите.
- Middleware
    - Се користат при филтирање на барања, како што се авторизација и автентикација, филтрирање на барања и внесени податоци.
- RESTful Routing
    - Laravel го поедноставува процесот на рутирање. и работа со кориснички и надворешни барања.

## 4.2 Vue

Vue.js is a progressive JavaScript framework designed for building user interfaces.

Vue.js е JavaScript фрејмвор кој е дизајниран за креирање на кориснички интерфејси. Нуди копонентно базирана архитектура (component-based arhitecture), оваа архитектура ни овозможува да го реискористуваме.


### Карактеристики на Vue

- Reactivity
    - Vue користи двосмерно поврзување на податоците (two-way data binding) и реактивни процеси кои ни овозмужуваат промена на податоците во реално време.
    - Vue исто така овозможува манипулација со податоците, без директно манипулирање на Dom елементите.
- Components
    - Vue ги енкапсулира UI елементите, логиката и стиловите, ова доведува до реискористување на кодот.
    - Девелоперите може да создаваат многу коплекси интерфесји користејќи ситни копоненти.
- Directives
    - Преставуваат специјални HTML елементи кои ни овозможуваат директна работа со DOM елементите. 
    - Примери за directives се: v-if, v-else, v-for, v-model и други.
- Vue Router:
    - Ни овозможува рендерирање на клиенкста страна, што ни овозможува да креираме single-page aplication(SPA).
    - Ни овозможува течна навигација низ апликацијата.
- State Menagment
    - Vuex е офијцална библиотека која се користи при state menagment. 
    - Сигурно и ефикасно го 
    



# 5. Податочна база и миграции

Во Laravel, миграциите претставуваат едноставен начин на управување со податочни структури. Тие ни дозволуваат да ја структурираме и организираме податочната база во нашата веб апликација. Laravel кориси ojbect-oriented начин за дефинирање на податочната база, тоа зчани дека без разлика каков податочен систем користиме на пример MySQL, PosgresSQL, SQLite или Manjaro, миграциите ќе работат секаде исто. 

Миграциите се PHP датотеки лоцирани во `/database/migrations` фолдерот во Laravel проектот. Секоја миграција претставува своја податочна шема, исто така дозволува бришење, промена на самите табели.

Laravel користи Object-Relational Mapping (ORM) исто така наречен Eloquent со кој комуницираме со базата. Eloquent ни дозволува работа со миграциите, креирање на квериња со што ни се олеснува работата.  



## Конфикурација и конекција со податочна база 

Laravel го прави конектирањето и работењето со податочни бази многу едноставен процес. Фајлот за конфигурација се наоѓа на `/app/config/database.php`. Во овој фајл ние може да ги дефинираме сите конекции, како и кои конекција.

Некогаш сакаме да направиме читање од една база, бришење во друга и обновување во трета. 


Пример:


``` php
'mysql' => array(
    'read' => array(
        'host' => '192.168.1.1',
    ),
    'write' => array(
        'host' => '196.168.1.2'
    ),
    'driver'    => 'mysql',
    'database'  => 'database',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
),
```


Доколку не сакаме да дефинираме се, Laravel дозволува да се конектираме до податочната база преку `.env` во која веќе имаме предефинирани конфигуразии за конекција со некоја база. `/config/database.php`, ова се користи доколку сакаме да дефинираме повеќе податочни бази и да правиме подетални променни на конфигурацијат.

Доколку сакате да направите промена на податочната од еден во друг тип, тоа може да го сторите на слендиот начин:

```php
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Во овој дел од .env може да ја направите измената. 


Пример за SQLite:

```php 
DB_CONNECTION=sqlite
DB_HOST=null
DB=DATABASE=/абсолутнаПатека
DB_PORT=null
DB_USERNAME=null
DB_PASSWORD=null
```

Пример за PosgresSQL:

``` php
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=mydatabase
DB_USERNAME=myuser
DB_PASSWORD=mypassword
```

Нашиот проект е направен со SQLite, па не мора да се прават никакви конекции, само е потребна патеката кон SQLite фајлот.

## Работа со прашалници

Од кога ќе ја дефинирата конекцијата кон податочната база, ние ќе може да извршуваме прашалници т.е queries. Со помош на `DB` ние ќе може да работиме со `select`, `update`, `insert`, `delete`. Ова може да го сториме така што во некоја од нашите методи ќе го искоритиме `DB::тип`, за да може да го користиме ова прво ќе мора да го импортираме `use Illuminate\Support\Facades\DB;` 

Пример за SELECT: 

[62]

```php
use Illuminate\Support\Facades\DB;

$users = DB::select('select * from users');

$getUserById = DB::select('select * from users where id = :id', ['id' => 1]);
```

## Како работат миграциите во Laravel

Миграциите преставуват некаков тип на version control на нашата податочна база, тие ни овозоможуваат лесен и сигрен начин при дефиниција и споделување на шемите.

### Креирање на миграија

За да се креира една миграција ние ја пишуваме следнава команда во нашиот терминал: `php artisan make:migration create_name_table`. Фајлот ќе биде зачуван во `/database/migrations/`.

```php
php artisan make:migration create_name_table
```

### Структура на миграцијата

Доколку сакаме да додадеме нов атрибут во миграцијата тоа го правиме во `function up` така што го користиме параметарот $table->тип('име').

``` php
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_votes');
    }
};
```

За да ја додадеме оваа шема во табелата ќе треба да напишеме:

```bash
php artisan migrate
``` 

Постојат многу типови на податоци кои може да ги искористите при креирање на миграција. Но јас ќе ги објаснам само тие што се наоѓаат во нашиот проект.

- Примарен клуч: под defult е `$table->id()` но доколку сакаме да го смениме, користиме `$table->primary('name')`, два или повеќе примарни клуча: `$table->primary(['primary1','primary2'],..)`
- Надворешен клуч: `$table->foreign('name')->references('attribute')->on('tableName');`
- Цел број: `$table->integer('name');`
- Булеан: `$table->boolean('name');`
- Текст: `$table->string('name');`
- Децимален број: `$table->float('name', 8, 2);`


| Команда                        | Опис                                                                                   |
| ------------------------------ | --------------------------------------------------------------------------------------------- |
| `php artisan migrate`          | Ќе ги мигрира само миграциите кои се во состојба pending.                                        |
| `php artisan migrate:fresh`    | Ги брише сите миграции и сите податоци од податчнат база така што го повикува down методот на секоја миграција како да сме направиле нова.         |
| `php artisan migrate:refresh`  | Ќе ги ресетира сите миграции и повторно ги креира така што прави drop на секоја табела. |
| `php artisan migrate:rollback` | Ќе ја негира последната миграција што сме ја направиле |

## Миграции од проектот

### create_posts_table

Оваа миграција е одговорна за креирање на табелата `posts` во податочната база.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`, се користи за идентификација на корисникот кој го создал постот.
- `flair_id`: Надворешен клуч кон табелата `falir`, се користи за идентификација на флаерот кој го одбрал корисникот.
- `image_id`: Надворешен клуч кон табелата `images` и се користи за прикачување на слика за постот.
- `body`: Текстот на постот.
- `spoiler`: Булеан вредност која означува дали постот е спојлер или не.

### create_communities_table

Оваа миграција е одговорна за креирање на табелата `communities` во податочната база.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`, се користи за идентификација на корисникот кој го создал community.
- `image_id`: Надворешен клуч кон табелата `images` и се користи за прикачување на слика за постот.
- `name`: Име на community, уникатно.
- `description`: Опис.
- `rules`: Текст кој ги пишува 

### create_images_table

Оваа миграција е одговорна за креирање на табелата `images` во подаочната база, се користи кога сакаме да зачуваме некоја слика.

- `id`: Примарен клуч
- `filename`: Име на сликата. 
- `path`: Релативна патека до Storage која може да се користи за да се пристапи до сликата.

### create_flairs_table

Оваа миграција е одговорна за креирање на табелата `images` во податочната база.

- `id`: Примарен клуч
- `community_id`: Надворешен клуч кон табелата `community`, се користи за да се ордеи на кој community припаѓа овој флаер.
- `name`: име на флаерот.

### create_post_votes и create_comment_votes

Овие миграција се одговорни за креирање на две табели, се користат за да се одреди на кој корисник „му се допаѓа“ (like) постот или коментарот и на кого „не му се допаѓа“(dislike). За comment е исто само што наместо `post_id`, имаме `community_id`.

- `post_id`, `user_id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`
- `post_id`: Надворешен клуч кон табелата `posts` 
- `vote`: Булеан вредност со која одредуваме дали станува за like или dislike.

### create_follows_table

Оваа миграција е одговорна за креирање на `follows` таблеа, оваа табела се користи кога сакаме да знаеме кој корисник кој community го следи.

- `user_id`, `community_id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users` 

### create_comments_table

Оваа миграција е одговорна за креирање на `comments` таблеа, оваа табела се користи за чување на коментарите на еден пост, од кој корисник.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`, ни кажува кој корисник го напишал коментарот.
- `post_id`: Надворешен клуч кон табелата `post_id`, одредува на кој пост 

### create_user_statuses_table

Оваа миграција е одговорна за креирање на `user_statuses` табела, оваа табела се користи кога сакаме да видиме дали корисникот е мометално активен или не.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`.
- `active`: Булеан вредност, со која се одреудва дали корисникот е мометално активен или не.
- `activity`: Датум и време, кога корисникот последно бил најавен на нашата апликација.

### create_user_karmas_table

Оваа миграција е одговорна за креирање на `user_karmas` табелата, оваа табела има за цел да го ја чува кармата на корисникот.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`.
- `karma`: Цел број, при лајк или дислајк се упдејтира оваа променлива.

### create_user_infos_table

Оваа миграција е одговорна за креирање на `user_infos` табела, оваа табела го чува описот и сликата на корисникот.

- `id`: Примарен клуч
- `user_id`: Надворешен клуч кон табелата `users`. Одредува за кој корисник станува збор.
- `bio`: Тескт поле во кое се чуваат дескрипцијата на корисникот.

### create_moderators_table

Оваа миграција е одговорна за креирање на `moderators` табела, оваа табела ги чува сите модератори на еден community. 

- `id`: Примарен клуч.
- `user_id`: Надворешен клуч кон табелата `users`. Одредува за кој корисник станува збор.
- `community_id`: За кој community станува збор. 


# 6. Архитектура и дизајн
При развој ние воглавно се потпираме на MVC шаблонот, но и за да ги подобриме перформансите користине и на дополнителен API слој.

- Models : ги содржи сите објекти кои ги користиме. Некои од нив се зачувуваат во база, но некои претставуваат DTOs (Data transfer Object) и служат само за комуникација.
- View : со помош на Inertia.js (библиотека што го премостува барањето помеѓу Laravel (контролер) и Vue.js (страница)).
- Controller: се справува со барањата. Прима барања од клиентот, ги обработува, комуницира со сервисот за да добие или ажурира податоци, а потоа враќа одговор на погледот или на самата vuejs апликација.
- Service: ја се справува бизнис логиката и комуницира со моделите и контролерите.

## 6.1 DTOs
За API слојот користиме DTOs.
Цели:
- едноставно пребарување на податоци
- скалабилност
- намалување на бројот на повици
- трансформација на податоци во друг формат
- исфрлање и додавање на потребни/непотребни полиња
- безбедност и енкапсулација
Сето ова го правиме преку наша прилагодлива имлементација на мапирачи.

#### CommentCreationRequest

Се добива од барањето за пишување на коментар преку CommentMapper.

| Parameter   | Type     | Description              |
|:------------|:---------|:-------------------------|
| `body`      | `string` | Содржината на коментарот |
| `post_id`   | `number` | Родителот на објавата    |
| `parent_id` | `number` | Родителот на коментарот  |

#### CommentUpdateRequest

Се добива од барањето за едитирање на коментар преку CommentMapper.

| Parameter    | Type     | Description                     |
|:-------------|:---------|:--------------------------------|
| `body`       | `string` | Содржината на коментарот        |
| `comment_id` | `number` | **Required** тековниот коментар |


#### CommentDto

Се праќа коментарот ремапиран од моделот Comment преку CommentMapper.

| Parameter           | Type      | Description                                                    |
|:--------------------|:----------|:---------------------------------------------------------------|
| `id`                | `number`  | **Required** тековниот коментар                                |
| `parent_comment_id` | `number`  | Коментар родител на тековниот коментар                         |
| `UserDto`           | `userDto` | **Required** Корисникот кој го напишал                         |
| `post_id`           | `number`  | Објава родител на тековниот коментар                           |
| `body`              | `string`  | Содржина на тековниот коментар                                 |
| `karma`             | `number`  | **Required** карма                                             |
| `date`              | `number`  | **Required** датум кога е напишан                              |
| `replies`           | `number`  | број на реплики                                                |
| `vote`              | `boolean` | најавениот корисник има гласано на коментарот                  |


#### CommunityCardDto

Се праќаaт основни информации за заедницата ремапирана од моделот Community преку CommunityMapper.

| Parameter     | Type     | Description                                        |
|:--------------|:---------|:---------------------------------------------------|
| `id`          | `number` | **Required** id на тековната заедница              |
| `name`        | `string` | **Required** Име на тековната заедница             |
| `about`       | `string` | **Required** Oпис на тековната заедница            |
| `rules`       | `string` | **Required** Правила за тековната заедница         |
| `activeUsers` | `number` | Број на активни корисници преку коментари и објави |
| `totalUsers`  | `number` | Број на корисници кои членуваат во заедницата      |
| `flairs`      | `аrray`  | **Required** Категории на заедницата               |


#### CommunityDto

Се праќа заедницата со уникатните карактеристики ремапирана од моделот Community преку CommunityMapper.

| Parameter     | Type     | Description                                        |
|:--------------|:---------|:---------------------------------------------------|
| `id`          | `number` | **Required** id на тековната заедница              |
| `name`        | `string` | **Required** Име на тековната заедница             |


#### PostCreationDto

Се добива од барањето за пишување објава.

| Parameter      | Type      | Description                                         |
|:---------------|:----------|:----------------------------------------------------|
| `community_id` | `number`  | **Required** id на заедницата каде припаѓа објавата |
| `title`        | `string`  | **Required** Наслов на објавата                     |
| `body`         | `string`  | **Required** Содржина на објавата                   |
| `image`        | `file`    | Слика                                               |
| `flair`        | `id`      | id на одбраната категорија                          |
| `spoiler`      | `boolean` | Дали се работи за спојлер                           |

#### PostDto

Се праќа објавата ремапирана од моделот Post преку PostMapper.

| Parameter         | Type           | Description                                      |
|:------------------|:---------------|:-------------------------------------------------|
| `id`              | `number`       | **Required** id на објавата                      |
| `title`           | `string`       | **Required** Наслов на објавата                  |
| `body`            | `string`       | **Required** Содржина на објавата                |
| `communityDto`    | `CommunityDto` | **Required** Заедницата на која припаѓа објавата |
| `userDto`         | `UserDto`      | **Required** Корисникот кој ја креирал објавата  |
| `image`           | `file`         | Слика                                            |
| `flair`           | `id`           | id на одбраната категорија                       |
| `spoiler`         | `boolean`      | Дали се работи за спојлер                        |
| `date`            | `string`       | Датум кога е креирана                            |
| `comments_number` | `number`       | Колку коментари содржи                           |
| `karma`           | `number`       | Карма                                            |
| `vote`            | `boolean`      | Дали најавениот корисник има гласано             |

#### UserDto

Се праќа корисникот ремапирана од моделот User преку UserMapper.

| Parameter  | Type           | Description                   |
|:-----------|:---------------|:------------------------------|
| `id`       | `number`       | **Required** id на корисникот |
| `userName` | `string`       | **Required** Корисничко име   |


#### CommentVoteDto

Се добива од барањето за гласање на коментар.

| Parameter | Type      | Description                                             |
|:----------|:----------|:--------------------------------------------------------|
| `id`      | `number`  | **Required** id на коментарот                           |
| `vote`    | `boolean` | **Required** дали корисникот прави upvote 1, downvote 0 |


#### PostVoteDto

Се добива од барањето за гласање на објава.

| Parameter | Type      | Description                                             |
|:----------|:----------|:--------------------------------------------------------|
| `id`      | `number`  | **Required** id на објавата                             |
| `vote`    | `boolean` | **Required** дали корисникот прави upvote 1, downvote 0 |





## 6.2 Model Mappers
За секој модел кој треба да го испратиме на API слојот, поминува преку т.н object mapper, кој е обична php класа и е имплементирана при потреба за да се добијат сите придобивки на перформанс, скалабилност и одржливост.
Користиме методи од сервисите на нашата апликација, преку dependency injection, така што се потребните сервиси се инјектираат во конструкторот на класата, што е вообичаен и препорачан пристап за имплементација на инјекција на зависност. Ова и овозможува на класата експлицитно да ги декларира своите зависности кога е конструирана.

### 6.2.1 Comment Mapper
```php
class CommentMapper
{

    public function __construct(private readonly UserMapper $userMapper,
    private readonly VoteService $voteService){}

    public function mapToDto(Comment $comment): CommentDto
    {
        $positiveVotes = CommentVote::all()->where('comment_id', $comment->id)
            ->where('vote', 1)->count();

        $negativeVotes = CommentVote::all()->where('comment_id', $comment->id)
            ->where('vote', 0)->count();

        $karma = $positiveVotes - $negativeVotes;

        $user = User::all()->find($comment->user_id);
        $AuthUser = Auth::user();
        $vote = $this->voteService->getCommentVotesByIds($AuthUser->id, $comment->id);

        $userDto = $this->userMapper->mapToDto($user);
        $commentDto = new CommentDto();
        $commentDto->setUserDto($userDto);
        $commentDto->setId($comment->id);
        $commentDto->setDate($comment->created_at);
        $commentDto->setParentCommentId($comment->parent_comment_id);
        $commentDto->setPostId($comment->post_id);
        $commentDto->setBody($comment->body);
        $commentDto->setKarma($karma);

        if($vote==null)
            $commentDto->setVote($vote);
        else{
            $commentDto->setVote($vote->vote);
        }

        $replies = Comment::where('parent_comment_id', $comment->id)->count();

        $commentDto->setRepliesNumber($replies);

        return $commentDto;
    }
```
Тука се поставуваат дополнителни полиња за рендерирање на еден коментар.
- Се поставува карма така што се прави разлика преку позитивните и негативните гласови.
- Се зема гласот на корисникот за коментарот (1, 0, null - нема гласано)
- Се земаат бројот на реплики така што се проверува на колку коментари parent_comment_id е исто со тековниот коментар.


### 6.2.2 Community Mapper

````php
class CommunityMapper
{

    public function mapToDto(Community $community)
    {
        $communityDto = new CommunityDto($community->id, $community->name);
        return $communityDto;
    }

    public function mapCollectionToDto($communities)
    {
        if($communities === null){
            return [];
        }
        else {
            return $communities->map(function ($community){
                return $this->mapToDto($community);
            });
        }
    }

}
````
CommunityMapper-от овозможува да не се праќаат сите полиња кои се чуваат во база, туку само оние што ни требаат.
За реискористливост имаме две функции каде што:
- мапираме community -> communityDto (ни требаат само име и идентификатор)
- collection -> communityDto collection (правиме на колекција ремапирање и ја повикуваме mapToDto)

### 6.2.3 Post Mapper

````php
class PostMapper
{
    public function __construct(private readonly VoteService $voteService){}


    public function mapToDto(Post $post): PostDto
    {
        $karma = $this->voteService->getPostKarma($post->id);
        $comments_number = Comment::all()->where('post_id', $post->id)->count();
        $postDto =  new PostDto($post->id, $post->title, $post->body, $post->created_at, $karma, $comments_number);
        $communityDto = new CommunityDto($post->community_id, $post->community->name);
        $userDto = new UserDto($post->user_id, $post->user->name);
        $user = Auth::user();
        $voted = $this->voteService->getPersonVote($user->id, $post->id);
        $postDto->setVote($voted);
        $postDto->setCommunityDto($communityDto);
        $postDto->setUserDto($userDto);
        $flair = Flair::find($post->flair_id);
        $postDto->setFlair($flair);

        return $postDto;
    }
}
````
Во зависнот од потребите и тука имаме неколку дополнителни полиња и намалување на непотребни полиња:
- карма - ја земаме од сервисот која што е разлика помеѓу позитивни и негативни гласови.
- број на коментари - гледаме на колку коментари post_id е идентификаторот на објавата.
- communityDto - иденктификатор и име на заедницата
- userDto - корисничко име и идентификатор на корисникот
- vote - дали тековно најавениот корисник гласал на објавата

### 6.2.4 User Mapper

````php
class UserMapper
{

    public function mapToDto(User $user)
    {
        return new UserDto($user->id, $user->name);
    }

}
````
Ги исфрламе останатите непотребни полиња поради безбедност и ефикасност.

## 6.3 Services
Сервисите комуницираат со останатите сервиси и со маперите, на истиот принцип преку dependency injection.
Се дефинираат во самиот конструктор како private readonly и се користат понатаму.

### 6.3.1 Comment Service
#### Враќање на коментари кои ги содржи една објава
````php
public function getPostComments(int $postId): \Illuminate\Support\Collection
    {

        $comments =  Comment->where('post_id', '=', $postId)->get();

        return $comments->map(function ($comment) {

            return $this->commentMapper->mapToDto($comment);
        });

    }
````
Јавна функција, која како параметар го прима идентификаторот на објавата и враќа колекција.
Од база се земаат сите коментари каде што полето post_id има иста вредност како идентификаторот што се праќа на параметар.
Потоа објектите на таа колекција се ремапираат во соодветното CommentDto и се враќа таа колекција.

#### Враќање на реплики кои ги содржи еден коментар
````php
public function getCommentReplies($commentId): \Illuminate\Support\Collection
    {

        $comments =  Comment->where('parent_comment_id', '=', $commentId)->get();

        return $comments->map(function ($comment) {

            return $this->commentMapper->mapToDto($comment);
        });
    }
````
Јавна функција, која како параметар го прима идентификаторот на коментарот и враќа колекција.
Од база се земаат сите коментари каде што полето parent_comment_id има иста вредност како идентификаторот што се праќа на параметар.
Потоа објектите на таа колекција се ремапираат во соодветното CommentDto и се враќа таа колекција.


#### Зачувување на коментар во база
````php
public function save(CommentCreationRequest $commentCreationRequest): void
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->body = $commentCreationRequest->body;
        $comment->post_id = $commentCreationRequest->post_id;
        $comment->parent_comment_id = $commentCreationRequest->parent_comment_id;
        $comment->user_id = $user->id;

        $comment->save();

    }
````
Јавна функција која не враќа резултат а, која на параметар прима објект од тип CommentCreationRequest.
$user = Auth::user();: Оваа линија го враќа моментално автентицираниот корисник користејќи ја фасадата за автентичност на Laravel. Претпоставува дека корисникот е најавен и ги користи автентицираните информации на корисникот за да го поврзе коментарот со корисникот.
Потоа се поставуваат директно сите полиња на Comment моделот и истиот се зачувува во база.

#### Едитирање на коментар
````php
public function edit(CommentUpdateRequest $commentUpdateRequest): void
    {
        $comment = Comment->find($commentUpdateRequest->comment_id);
        $comment->body = $commentUpdateRequest->body;

        $comment->save();
    }
````
Јавна функција која не враќа резултат а, која на параметар прима објект од тип CommentUpdateRequest.
Се пронајдува коментарот за кој се испраќа $commentUpdateRequest преку поставеното comment_id, па потоа наново се сетира неговото body со тоа од $commentUpdateRequest.
Се зачувува во база.


#### Гласање на коментар
````php
public function vote(CommentVoteDto $commentVoteDto, User $user): int
    {

        $commentVote = $this->voteService->getCommentVotesByIds($user->id, $commentVoteDto->id);

        if($commentVote != null){
            $this->voteService->deleteCommentVote($user->id, $commentVoteDto->id);
        }
        $commentVoteNew = new CommentVote();
        $commentVoteNew->user_id = $user->id;
        $commentVoteNew->comment_id = $commentVoteDto->id;
        $commentVoteNew->vote = $commentVoteDto->vote;


        $commentVoteNew->save();

        return $this->voteService->getCommentKarma($commentVoteDto->id);
    }
````
Јавна функција која враќа број како резултат.
Прво се проверува дали корисникот веќе има гласано на тој коментар (само еднаш може корисникот да гласа на коментар, со 1 или 0). Ако да, тогаш тој глас се брише.
Се креира нов глас CommentVote и се сетираат неговите полиња и се зачувува во база.
Потоа се од $this->voteService->getCommentKarma($commentVoteDto->id) се враќа новата апдејтирана карма за тој коментар.

#### Бришење на коментар
````php
public function delete(int $commentId): void
    {
        Comment::destroy($commentId);
        $this->getCommentReplies($commentId)->delete();
    }
````
Јавна функција за бришење која на параметар го прима идентификаторот на коментарот кој треба да се избрише.
Прво се брише само коментарот преку неговиот идентификатор, а потоа се бришат и репликите на тој коментар.

#### Земање на коментар преку идентификатор
````php
public function getById($id)
    {
        return Comment::with('user')->find($id);
    }
````
Јавна функција која го враќа коментарот или null ако не постои таков.
На параметар го прима идентификаторот на коментарот.


#### Враќање на коментари од корисник
````php
public function getAllCommentsByUserId($id)
    {
        return Comment::where('user_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }
````
Јавна функција која го прима преку параметар идентификаторот на корисникот за кој се проверува и враќа колекција како резултат.
Comment::where('user_id', $id) гради барање за базата на податоци за да ги врати записите од табелата со коментари каде што колоната user_id се совпаѓа со даденото $id.
Потоа се подредуваат преземените коментари по нивната колона create_at во опаѓачки редослед. Ова значи дека неодамна креираните коментари ќе се појават први во сетот на резултати.
И за крај се земаат совпаѓачките коментари и се враќаат како резултат.

### 6.3.2 Community Service

#### Враќање на сите заедници кои корисникот ги следи
````php
public function getUserCommunities(User $user){
        $communities = Follow::where('user_id', $user->id)->pluck('community_id');

        return Community::whereIn('id', $communities)->get();
    }
````
Јавна функција која на параметар прима корисник за кој сакаме да ги пронајдеме заедниците кои ги следи.
Се земаат сите Follow објекти каде што user_id има иста вредност со она на корисникот од параметар, и се враќаат како резултат само листа од community_id.
Како резултат на функцијата се враќаат сите Community кои што се во листата на идентификатори.



#### Враќање на број на корисници кои ја следат заедницата
````php
public function getTotalUsers($id): int
    {
        return Follow::with('community')->where('community_id',$id)->count();
    }
````
Јавна функција која на влезен параметер прима идентификатор на заедницата.
Со query се земаат сите Follow објекти каде што community_id е исто со влезниот идентификатор и се бројат.
Се враќа вкупниот број.


#### Враќање на сите активни корисници
````php
public function getActiveUsers($id): int
    {
        $usersFromPost = Post::select('user_id')->distinct();
        $usersFromComments = Comment::select('user_id')->distinct();

        return $usersFromPost->union($usersFromComments)->distinct()->count();
    }
````
Јавна функција која на влезен параметар го прима идентификаторот на заедницата и враќа број на активни корисници.
Активни корисници се сметаат оние кои пишувале коментари или пишувале објави.
За таа цел ги земаме сите различни корисници од записите од табелите објави и коментари, и му правиме унија, за на крај повторно да ги извлечеме различните корисници и ги броиме.
Тој број се враќа како резултат.


#### Враќање на сите заедници
````php
public function getAllCommunities(): \Illuminate\Database\Eloquent\Collection
    {
        return Community::all();
    }
````
Јавна функција која не прима ништо на параметар, а ги враќа сите заедници како колекција.

#### Враќање на основни информации за една заедница
````php
public function getCommunityCard($id): array
    {
        $community = Community::with('user', 'flairs', 'image')->find($id);
        $cardDto = new CommunityCardDto();
        $cardDto->name = $community->name;
        $cardDto->id = $community->id;
        $cardDto->about = $community->description;
        $cardDto->rules = $community->rules;
        $cardDto->activeUsers = $this->getActiveUsers($id);
        $cardDto->totalUsers = $this->getTotalUsers($id);
        $cardDto->flairs = $this->flairService->getCommunitiesFlairs($community->id);

        return [$cardDto];
    }
````
Јавна функција која го прима идентификаторот на заедницата како влезеен параметар и враќа $cardDto како низа.
Првично се зема Community со сите нејзини релации, па потоа се прави CommunityCardDto со сите негови полиња.
Се враќа $cardDto како низа.

#### Враќање на описот на заедницата
````php
public function getCommunityDescription($id){
        return Community::find($id)->description;
    }
````
Јавна функција која како параметар го прима идентификаторот на заедницата и го враќа нејзиниот опис.

#### Враќање на правилата на една заедница
````php
public function getCommunityRules($id){
        return Community::find($id)->rules;
    }
````
Јавна функција која како параметар го прима идентификаторот на заедницата и ги враќа правилата.


### 6.3.3 Flair Service

#### Враќање на категориите на една заедница
````php
public function getCommunitiesFlairs($communityId){
        return Flair::where('community_id', $communityId)->get()->toArray();
    }
````
Јавна функција која како влезен параметар го прима идентификаторот на заедницата, а враќа низа со категории на заедницата.


### 6.3.4 Post Service


#### Враќање на тековната објава
````php
public function getById(int $id)
    {
        return Post::with('user','image','community', 'comments')->find($id);
    }
````
Јавна фунцкија која го прима идентификаторот на објавата, а ја враќа објавата со сите релации како резултат.


#### Едитирање на објава
````php
public function edit(PostCreationDto $postCreationDto): void
    {
        $post = Post::with('image')->find($postCreationDto->id);
        $post->title = $postCreationDto->title;
        $post->body = $postCreationDto->body;

        $post->save();
    }
````
Јавна функција која не враќа резултат а прима $postCreationDto како влезен параметар.
Се бара тековната објава во база, и наново се сетираат насловот и содржината и за зачувува во база.

#### Гласање на објава
````php
public function vote_Post(PostVoteDto $postVoteDto, User $user): int
    {
       
        $postVote = $this->voteService->getPostVotesByIds($user->id, $postVoteDto->post_id);

        if($postVote != null){
            $this->voteService->deletePostVote($user->id, $postVoteDto->post_id);
        }
        $postVoteNew = new PostVote();
        $postVoteNew->user_id = $user->id;
        $postVoteNew->post_id = $postVoteDto->post_id;
        $postVoteNew->vote = $postVoteDto->vote;


        $postVoteNew->save();

        return $this->voteService->getPostKarma($post->id);
    }
````
Јавна функција која како влезни параметри ги прима $postVoteDto и $user. Враќа број како резултат.
Првично се проверува дали корисникот има гласано на таа објава, и ако има тој глас се брише.
Ако нема, се креира PostVote, се сетираат неговите полиња, и за зачувува во база.
Потоа се зема ново пресметана карма за таа објава, и се враќа како резултат.

#### Бришење на објава
````php
public function delete(int $id): int
    {
        return Post::destroy($id);
    }
````
Јавна функција која како параметар го прима идентификаторот на објавата, ја брише таа објава и го враќа бројот на записи кои се избришани.

#### Враќање на објави на заедници кои ги следи корисникот
````php
public function getFollowingPosts() {
        $user = Auth::user();
        $communityIds = $this->communityService->getUserCommunities($user)->map(function ($community) {
            return $community->id;
        });
        return Post::whereIn('community_id', $communityIds);
    }
````
Јавна функција која не прима ништо на параметар, но ги враќа сите објави кои ги следи корисникот.
Се зема корисникот од автентикација со претпоставка дека е најавен.
Потоа се земаат сите идентификатори од сите заедници во кои тој членува.
И за крај се филтирираат сите објави исе враќаат само оние кои ги има во листата.

#### Враќање на најкоментирани објави од сите заедници
````php
public function getTrendingPosts(): \Illuminate\Database\Query\Builder
    {
        return DB::table('posts')
            ->leftJoin('comments', 'posts.id', '=', 'comments.post_id')
            ->select('posts.*', DB::raw('COUNT(comments.id) as comment_count'))
            ->groupBy('posts.id')
            ->orderByDesc('comment_count');
    }
````
Јавна функција која не прима ништо на влезен параметар, а враќа query Builder.
Конструира барање за базата на податоци за да ги врати трендинг објавите со спојување на табелите „објави“ и „коментари“, броејќи го бројот на коментари за секоја објава и подредувајќи го резултатот врз основа на бројот на коментари во опаѓачки редослед.

#### Враќање на сите објави заедница
````php
public function getCommunityPosts(Community $community){
        return Post::where('community_id', $community->id);
    }
````
Јавна функција која како параметар прима Community објект, и ги враќа сите објави кои го содржат идентификаторот на тој објект.


#### Враќање на објави од даден корисник
````php
public function getAllPostsByUserId($id)
    {
        return Post::where('user_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc');
    }
````
Јавна функција која како параметар го прима идентификаторот за даден корисник, и ги враќа неговите објави во опаѓачки редослед.

### 6.3.4 UserInfo Service

#### Враќање на UserInfo на даден корисник
````php
public function getById($id){
        return UserInfo::where('user_id', $id)->first();
    }
````
Јавна функција која како параметар го прима идентификаторот на корисникот, а го враќа UserInfo кој се совпаѓа со него. 

### 6.3.5 User Service

#### Враќање на логираниот корисникот
````php
public function getLoggedInUser(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
````
Се враќа логираниот корисник од автентификација.

#### Сменување на статусот на корисник
````php
private function userActivity($user): void
    {
        if (!is_null($user->id)) {
            $userStatus = UserStatus::where('user_id', $user->id)->first();
            if (!is_null($userStatus)) {
                $userStatus->updateActiveStatus();
            }
        }

    }
````
Јавна функција која не враќа резултат, а го прима корисникот како влезен параметар.

#### Враќање на корисникот по идентификатор
````php
public function getUserById($userId)
    {
        return  User::with('karma','status','info')->where('id',$userId)->firstOrFail();
    }
````


#### Враќање на корисникот по корисничко име
````php
public function getUserByName($name){
        $user =  User::with('karma','status','info')->where('name', $name)->firstOrFail();
        $this->userActivity($user);
        return $user;
    }
````
### 6.3.6 Vote Service

#### Враќање на карма на дадена објава
````php
public function getPostKarma($postId): int
    {

        $positiveVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 1)->count();

        $negativeVotes = PostVote::all()->where('post_id', $postId)
            ->where('vote', 0)->count();

        return $positiveVotes - $negativeVotes;

    }
````
Јавна функција која како аргумент го прима идентификаторот на објава, а ја враќа разликата помеѓу позитивни и негативни гласови.

#### Враќање на карма на даден коментар
````php
public function getCommentKarma($commmentId): int
    {

        $positiveVotes = CommentVote::all()->where('comment_id', $commmentId)
            ->where('vote', 1)->count();

        $negativeVotes = CommentVote::all()->where('comment_id', $commmentId)
            ->where('vote', 0)->count();

        return $positiveVotes - $negativeVotes;

    }
````
Јавна функција која како параметар го прима идентификаторот на даден коменар, а ја враќа разликата помеѓу позитивни и негативни гласови.


#### Враќање на глас за објава
````php
public function getPersonVote($userId, $postId){

        $vote = $this->getPostVotesByIds($userId, $postId);

        if($vote == null) return null;
        else return $vote->vote;
    }
````
Јавна функција која како параметар ги прима идентификаторите на корисник и објава, го враќа гласот на корисникот за тековната објава.


#### Враќање на глас за коментар
````php
public function getPersonCommentVote($userId, $commentId){

        $vote = $this->getCommentVotesByIds($userId, $commentId);

        if($vote == null) return null;
        else return $vote->vote;
    }
````
Јавна функција која како параметар ги прима идентификаторите на корисник и коментар, го враќа гласот на корисникот за тековниот коментар.


#### Враќање на PostVote за корисник и објава
````php
public function getPostVotesByIds($userId, $postId){

        return PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->first();
    }
````

#### Враќање на CommentVote за корисник и коментар
````php
public function getCommentVotesByIds($userId, $commentId){

        return CommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->first();
    }

````


#### Бришење на глас за објава
````php
public function deletePostVote($userId, $postId): int
    {

        PostVote::where([
            'user_id' => $userId,
            'post_id' => $postId
        ])->delete();

        return $this->getPostKarma($postId);
    }
````
Јавна функција која како параметат ги прима идентификаторите на корисник и објава, го брише тој глас,  а ја враќа новата вредност на карма.


#### Бришење на глас за коментар
````php
public function deleteCommentVote($userId, $commentId): int
    {

        CommentVote::where([
            'user_id' => $userId,
            'comment_id' => $commentId
        ])->delete();

        return $this->getCommentKarma($commentId);
    }
````
Јавна функција која како параметар ги прима идентификаторите на корисникот и на коментарот, го брише тој глас, и ја враќа новопресметаната карма.

## 6.4 Controllers
Контролерите комуницираат со сервисите и со маперите преку dependency injection директно во конструкторот.

### 6.4.1 Comment Controller

#### Коментари на објави
````php
public function getPostComments($id): \Illuminate\Support\Collection
    {
        return $this->commentService->getPostComments($id);
    }
````
Јавна функција која го прима идентификаторот на објавата како параметар, и ја повикува getPostComments од сервисот. 
Враќа колекција од коментари.

#### Реплики на коментари
````php 
public function getCommentReplies($id): \Illuminate\Support\Collection
    {
        return $this->commentService->getCommentReplies($id);
    }
````
Јавна функвија која го прима идентификаторот на коментарот родител, и враќа колекција од реплики.

#### Креирање на коментар
````php
public function create(Request $request): array
    {
        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $comment = new Comment();
        $comment->user_id = $user->id;

        if(isset($jsonData['post_id']))
            $comment->post_id = $jsonData['post_id'];

        if(isset($jsonData['parent_comment_id']))
            $comment->parent_comment_id = $jsonData['parent_comment_id'];

        $comment->body = $jsonData['body'];

        $comment->save();

        $commentDto = $this->commentMapper->mapToDto($comment);

        return [$commentDto];

    }
````
Јавна функција која го прима Request како параметар, а враќа низа од $commentDto.
Се зема од $jsonData содржината и се проверува дали е сетирана бидејќи post_id и parent_comment_id се опционални, но секогаш едното од нив не е null.
Се креира Comment обејкт и се сетираат неговите полиња, се зачувува и се враќа како низа.

#### Едитирање на коментар
````php
public function edit(Request $request, $id){
        $comment = Comment::find($id);
        $jsonData = json_decode($request->getContent(), true);
        $comment->body = $jsonData['body'];

        $comment->save();

        return $comment;
    }
````
Јавна функција која го прима Request како параметар и идентификаторот на коментарот, а го враќа самиот коментар.
Се зема од $jsonData содржината и телото на објавата и се зачувува.
Потоа се враќа самиот коментар како резултат.


#### Гласање на коментар
````php
public function vote(Request $request, int $id): int
    {

        $user = Auth::user();

        $jsonData = json_decode($request->getContent(), true);

        $commentVoteDto = new CommentVoteDto();
        $commentVoteDto->id = $jsonData['id'];
        $commentVoteDto->vote = $jsonData['vote'];

        $userKarmaController = new UserKarmaController();
        $comment = $this->commentService->getById($id);


        if($commentVoteDto->vote == 1){
            $userKarmaController->upVote($comment->user_id);
        }else if($commentVoteDto->vote == null){
            $userKarmaController->downVote($comment->user_id);

        }

        return $this->commentService->vote($commentVoteDto, $user);

    }
````
Јавна функција која го прима Request како параметар и идентификаторот на коментарот, а ја враќа тековната карма на коментарот.
Се зема од $jsonData содржината: идентификаторот на коментарот и гласот (1 или 0).
Се праќа на сервисот и се враќа карма.

#### Бришење на глас за коментар
````php
public function deleteVote($id): int
    {
        $user = Auth::user();

        $userKarmaController = new UserKarmaController();
        $comment = $this->commentService->getById($id);
        $karma = $this->voteService->getCommentVotesByIds($user->id, $comment->id)->vote;


        if($karma == 0){
            $userKarmaController->upVote($comment->user_id);
        }else{
            $userKarmaController->downVote($comment->user_id);
        }


        return $this->voteService->deleteCommentVote($user->id, $id);
    }
````
Јавна функција која го брише гласот за даденито коментар.


#### Бришење на коментар
````php
public function delete($commentId){
        Comment::destroy($commentId);
    }
````

### 6.4.1 Community Controller

#### Враќање на едит форма
````php
public function createEditForm(): \Inertia\Response
    {
        return Inertia::render('Communities/CommunityForm');
    }
````
Јавна функција која нема влезен параметар, но ја враќа CommunityForm page-компонентата.


#### Креирање на заедница
````php
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
````

####
````php
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
````

####
````php
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
````


####
````php
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
````


#### Основни информации за заедница
````php
public function getCard($id)
    {
        return $this->communityService->getCommunityCard($id);

    }
````


#### Заедници на корисникот
````php
public function userCommunities()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();
        return $this->communityMapper->mapCollectionToDto($this->communityService->getUserCommunities($user));
    }
````


#### Пагинација во заедница
````php
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
````
Јавна функција која преку влезен параметар ги има идентификаторот на заедницата и Request.
Дополнително, во телото на функцијата се наоѓа sort параметар кој има вредности new или trending.
Од jsondata се читаат тие вредности и се проверува:
- ако е new: се земаат сите објави и се сортираат според датум во опаѓачки реднослед, така што најновите ќе бидат први.
Се прави пагинација со 2 објави по страна.
- ако е trendning: се зема Post табелата и се спојува со PostVotes. Се збираат гласовите на објавите каде што community_id е тековното id со алиас карма.
Се прави сортирање по карма во опаѓачки редослед, така што најгласаните ќе бидат први.
Потоа се прави ремапирање и се враќаат Post како PostDto.

#### Правила на заедница
````php
public function rules($id){
        return $this->communityService->getCommunityRules($id);
    }
````

#### Опис на заедница
````php
public function description($id){
        return $this->communityService->getCommunityDescription($id);
    }
````


