<?php declare(strict_types=1);


namespace App\Models;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class CourseMain
 *
 * @since 2.0
 *
 * @Entity(table="course_main")
 */
class CourseMain extends Model
{
    /**
     * 
     * @Id()
     * @Column(name="item_id", prop="itemId")
     *
     * @var int
     */
    private $itemId;

    /**
     * 
     *
     * @Column(name="course_title", prop="courseTitle")
     *
     * @var string|null
     */
    private $courseTitle;

    /**
     * 
     *
     * @Column(name="course_ltitle", prop="courseLtitle")
     *
     * @var string|null
     */
    private $courseLtitle;

    /**
     * 
     *
     * @Column(name="course_price", prop="coursePrice")
     *
     * @var float|null
     */
    private $coursePrice;

    /**
     * 默认10
     *
     * @Column(name="course_disc", prop="courseDisc")
     *
     * @var int|null
     */
    private $courseDisc;

    /**
     * 0审核中 1已发布 2已下架
     *
     * @Column(name="course_status", prop="courseStatus")
     *
     * @var int|null
     */
    private $courseStatus;

    /**
     * 
     *
     * @Column(name="course_intr", prop="courseIntr")
     *
     * @var string|null
     */
    private $courseIntr;

    /**
     * 
     *
     * @Column(name="course_body", prop="courseBody")
     *
     * @var string|null
     */
    private $courseBody;

    /**
     * 
     *
     * @Column(name="course_pubtime", prop="coursePubtime")
     *
     * @var string|null
     */
    private $coursePubtime;

    /**
     * 
     *
     * @Column(name="course_edittime", prop="courseEdittime")
     *
     * @var string|null
     */
    private $courseEdittime;


    /**
     * @param int $itemId
     *
     * @return void
     */
    public function setItemId(int $itemId): void
    {
        $this->itemId = $itemId;
    }

    /**
     * @param string|null $courseTitle
     *
     * @return void
     */
    public function setCourseTitle(?string $courseTitle): void
    {
        $this->courseTitle = $courseTitle;
    }

    /**
     * @param string|null $courseLtitle
     *
     * @return void
     */
    public function setCourseLtitle(?string $courseLtitle): void
    {
        $this->courseLtitle = $courseLtitle;
    }

    /**
     * @param float|null $coursePrice
     *
     * @return void
     */
    public function setCoursePrice(?float $coursePrice): void
    {
        $this->coursePrice = $coursePrice;
    }

    /**
     * @param int|null $courseDisc
     *
     * @return void
     */
    public function setCourseDisc(?int $courseDisc): void
    {
        $this->courseDisc = $courseDisc;
    }

    /**
     * @param int|null $courseStatus
     *
     * @return void
     */
    public function setCourseStatus(?int $courseStatus): void
    {
        $this->courseStatus = $courseStatus;
    }

    /**
     * @param string|null $courseIntr
     *
     * @return void
     */
    public function setCourseIntr(?string $courseIntr): void
    {
        $this->courseIntr = $courseIntr;
    }

    /**
     * @param string|null $courseBody
     *
     * @return void
     */
    public function setCourseBody(?string $courseBody): void
    {
        $this->courseBody = $courseBody;
    }

    /**
     * @param string|null $coursePubtime
     *
     * @return void
     */
    public function setCoursePubtime(?string $coursePubtime): void
    {
        $this->coursePubtime = $coursePubtime;
    }

    /**
     * @param string|null $courseEdittime
     *
     * @return void
     */
    public function setCourseEdittime(?string $courseEdittime): void
    {
        $this->courseEdittime = $courseEdittime;
    }

    /**
     * @return int
     */
    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    /**
     * @return string|null
     */
    public function getCourseTitle(): ?string
    {
        return $this->courseTitle;
    }

    /**
     * @return string|null
     */
    public function getCourseLtitle(): ?string
    {
        return $this->courseLtitle;
    }

    /**
     * @return float|null
     */
    public function getCoursePrice(): ?float
    {
        return $this->coursePrice;
    }

    /**
     * @return int|null
     */
    public function getCourseDisc(): ?int
    {
        return $this->courseDisc;
    }

    /**
     * @return int|null
     */
    public function getCourseStatus(): ?int
    {
        return $this->courseStatus;
    }

    /**
     * @return string|null
     */
    public function getCourseIntr(): ?string
    {
        return $this->courseIntr;
    }

    /**
     * @return string|null
     */
    public function getCourseBody(): ?string
    {
        return $this->courseBody;
    }

    /**
     * @return string|null
     */
    public function getCoursePubtime(): ?string
    {
        return $this->coursePubtime;
    }

    /**
     * @return string|null
     */
    public function getCourseEdittime(): ?string
    {
        return $this->courseEdittime;
    }

}
