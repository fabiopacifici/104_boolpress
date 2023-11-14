# Relationships

- create the new model with migration and seeder
- define the migration structure
- define the pivot table
- migrate the tables
- create seeder
- seed the db
- add relationships inside both models

## create the new model with migration and seeder

```
php artisan make:model Tag -ms
```

## define the tags migration structure

```php
 /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('slug', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }

```

## define the pivot table

create the table

```bash
php artisan make:migration create_post_tag_table
```

⚡ATTENTION: The table name must follow the convention (singular table names in alphabetical order)

add columns to the pivot table

```php
 public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts');

            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');

            // instead of the $table->id()
            $table->primary(['post_id', 'tag_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
```

## Migrate the db

`php artisan migrate`

## Seeder

## Seed the db

## Add relationships

Inside the model Post

```php

// Post.php



    /**
     * The tags that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

```

Inside the Tags model define the inverse of the relationship

```php

  /**
     * The posts that belong to the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
```

⚡ NOTE:
If a method uses a return type you need to import that class at the top

```php
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

```
