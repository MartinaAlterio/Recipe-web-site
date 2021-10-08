<?php


namespace App\Models;


class IngredientsContent{

    /**
     * @var array
     */
    protected $upTitle;

    /**
     * @var array
     */
    protected $underTitle;

    /**
     * @var array
     */
    protected $description;

    /**
     * @var array
     */
    protected $title;

    /**
     * @return array
     */
    public function getUpTitle(): array
    {
        return $this->upTitle;
    }

    /**
     * @return array
     */
    public function getUnderTitle(): array
    {
        return $this->underTitle;
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getTitle(): array
    {
        return $this->title;
    }


    /**
     * @param  array  $upTitle
     */
    public function SetUpTitle(array $upTitle) {
        $this->upTitle = $upTitle;
    }

    /**
     * @param  array  $underTitle
     */
    public function SetUnderTitle(array $underTitle) {
        $this->underTitle = $underTitle;
    }

    /**
     * @param  array  $description
     */
    public function SetDescription(array $description) {
        $this->description = $description;
    }

    /**
     * @param  array  $title
     */
    public function SetTitle(array $title) {
        $this->title = $title;
    }
}
