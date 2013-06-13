<?php

class Blog extends Model
{
    public static $_table = 'blog_entries';

    public function comments()
    {
        return $this->has_many('Comment', 'entry_id');
    }
}