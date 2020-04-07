<?php
namespace App\Rpc\Service;
use App\Models\CourseMain;
use App\Models\CourseMetas;
use App\Models\CourseModel;
use App\Rpc\Lib\ICourse;
use Swoft\Rpc\Server\Annotation\Mapping\Service;

/**
 * Class CourseService
 * @package App\Rpc\Service
 * @Service()
 */
class CourseService implements ICourse {

    public function list($size) {
        return ["list1"];
    }

    public function get($id) {
        $main=CourseMain::find($id);
        $metas=CourseMetas::where("course_id",$id)->get();

        $model=new CourseModel();
        $model->setCourseMain($main);
        $model->setCourseMetas($metas);
        return  $model->toArray();
    }

}