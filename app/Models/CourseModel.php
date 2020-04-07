<?php
namespace App\Models;
class CourseModel{
    /** @var $course_main CourseMain */
    protected $course_main;

    /** @var $course_metas CourseMetas */
    protected $course_metas;

    public function toArray(){
        return [
           "course"=>$this->course_main->toArray(),
            "metas"=>$this->course_metas->toArray()
        ];
    }
    /**
     * @return mixed
     */
    public function getCourseMain()
    {
        return $this->course_main;
    }

    /**
     * @param mixed $course_main
     */
    public function setCourseMain($course_main): void
    {
        $this->course_main = $course_main;
    }

    /**
     * @return mixed
     */
    public function getCourseMetas()
    {
        return $this->course_metas;
    }

    /**
     * @param mixed $course_metas
     */
    public function setCourseMetas($course_metas): void
    {
        $this->course_metas = $course_metas;
    }

}