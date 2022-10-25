<?php

namespace App\Console\Commands;

use App\Mail\AutoMail;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:autoMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $avg = 'csdaas';
        // $mailable = new AutoMail($avg);
        // Mail::to('hiepntph15608@fpt.edu.vn')->queue($mailable);
        // $subjects = $this->subjectRepo->newModel()->get();
        // $students = $this->studentRepo->newModel()->with('subjects')->get();

        $subjects = Subject::get();
        $students = Student::with('subjects')->get();

        foreach ($students as $student) {
            if ($student->subjects->count() == $subjects->count()) {
                for ($i = 0; $i < $subjects->count(); $i++) {
                    if (!$student->subjects[$i]->pivot->point) {
                        break;
                    } elseif ($i == $subjects->count() - 1) {
                        $avg = $student->subjects->avg('pivot.point', 2);
                        if (!$student['status']) {
                            if ($avg < 5) {
                                $student['status'] = '1';
                                $student->update([
                                    'status' => $student['status']
                                ]);
                           
                                $mailable = new AutoMail($avg);
                                Mail::to($student->email)->queue($mailable);
                            }
                        }
                    }
                }
            }
        }
        // return 0;
    }
}
