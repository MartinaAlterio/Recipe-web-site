<?php


namespace App\Models;


class HomeContent {
    
    /**
     * @var array
     */
    protected $title;

    /**
     * @var array
     */
    protected $subtitle;

    /**
     * @var array
     */
    protected $recipes;

    /**
     * @var array
     */
    protected $ingredients;

    /**
     * @var array
     */
    protected $about_me;

    /**
     * @return array
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * @return array
     */
    public function getRecipes() {
        return $this->recipes;
    }

    /**
     * @return array
     */
    public function getIngredients() {
        return $this->ingredients;
    }

    /**
     * @return array
     */
    public function getAboutMe() {
        return $this->about_me;
    }

    /**
     * @param  array  $title
     */
    public function setTitle(array $title) {
        $this->title = $title;
    }

    /**
     * @param  array  $subtitle
     */
    public function setSubtitle(array $subtitle) {
        $this->subtitle = $subtitle;
    }

    /**
     * @param  array  $recipes
     */
    public function setRecipes(array $recipes) {
        $this->recipes = $recipes;
    }

    /**
     * @param  array  $ingredients
     */
    public function setIngredients(array $ingredients) {
        $this->ingredients = $ingredients;
    }

    /**
     * @param  array  $about_me
     */
    public function setAboutMe(array $about_me) {
        $this->about_me = $about_me;
    }
}