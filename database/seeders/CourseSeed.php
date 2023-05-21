<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\Category;
use App\Models\Blog;
use App\Models\CourseTimeline;
use App\Models\Media;
use App\Models\Order;
use App\Models\Bundle;


class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        //Adding Categories
        Category::factory()->count(10)->create()->each(function ($cat) {
            $cat->blogs()->saveMany(Blog::factory()->count(4)->create());

        });

        //Creating Course
        Course::factory()->count(50)->create()->each(function ($course) {

            $course->teachers()->sync([2]);
            $course->lessons()->saveMany(Lesson::factory()->count(10)->create());
            foreach ($course->lessons()->where('published', '=', 1)->get() as $key => $lesson) {
                $key++;
                $timeline = new CourseTimeline();
                $timeline->course_id = $course->id;
                $timeline->model_id = $lesson->id;
                $timeline->model_type = Lesson::class;
                $timeline->sequence = $key;
                $timeline->save();
            };

            $course->tests()->saveMany(Test::factory()->count(2)->create());
            foreach ($course->tests as $key => $test) {
                $key += 11;
                $timeline = new CourseTimeline();
                $timeline->course_id = $course->id;
                $timeline->model_id = $test->id;
                $timeline->model_type = Test::class;
                $timeline->sequence = $key;
                $timeline->save();
            };
        });

        $courses = Course::get();

       foreach ($courses as $course) {
    $timeline = $course->courseTimeline->where('sequence', '=', 1)->first();
    if ($timeline instanceof Illuminate\Database\Eloquent\Collection) {
        $lesson_id = $timeline->model_id;
        $lesson = Lesson::find($lesson_id);
        $media = Media::where('type', '=', 'upload')
            ->where('model_type', '=', 'App\Models\Lesson')
            ->where('model_id', '=', $lesson->id)
            ->first();
        $filename = 'placeholder-video.mp4';
        $url = asset('storage/uploads/' . $filename);

        if ($media == null) {
            $media = new Media();
            $media->model_type = Lesson::class;
            $media->model_id = $lesson->id;
            $media->name = $filename;
            $media->url = $url;
            $media->type = 'upload';
            $media->file_name = $filename;
            $media->size = 0;
            $media->save();
        }

        $order = new Order();
        $order->user_id = 3;
        $order->reference_no = str_random(8);
        $order->amount = $course->price;
        $order->status = 1;
        $order->save();

        $order->items()->create([
             'item_id' => $course->id,
                'item_type' => get_class($course),
                'price' => $course->price
        ]);
        generateInvoice($order);

        foreach ($order->items as $orderItem) {
            $orderItem->item->students()->attach(3);
        }
    }
}



        //Creating Bundles
        Bundle::factory()->count(10)->create()->each(function ($bundle) {
            $bundle->user_id = 2;
            $bundle->save();
            $bundle->courses()->sync([ rand(1,50) , rand(1,50) , rand(1,50)  ]);
        });


        $bundles = Bundle::get()->take(2);

        foreach ($bundles as $bundle){
            $order = new Order();
            $order->user_id = 3;
            $order->reference_no = str_random(8);
            $order->amount = $bundle->price;
            $order->status = 1;
            $order->save();

            $order->items()->create([
                'item_id' => $bundle->id,
                'item_type' => get_class($bundle),
                'price' => $bundle->price
            ]);
            generateInvoice($order);

            foreach ($order->items as $orderItem) {
                //Bundle Entries
                if($orderItem->item_type == Bundle::class){
                    foreach ($orderItem->item->courses as $course){
                        $course->students()->attach($order->user_id);
                    }
                }
                $orderItem->item->students()->attach($order->user_id);
            }
        }
    }
}