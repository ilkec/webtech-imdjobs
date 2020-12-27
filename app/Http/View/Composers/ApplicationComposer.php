<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ApplicationComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    /*public function __construct(UserRepository $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
    }*/

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->with('company')->first();
    
        if (!empty($data['users']->company[0])) {
            $data['count'] = [];
            $data['countApplications'] = [];
            $data['application'] = \App\Models\Companies::where('user_id', $id)->with('internship.application')->get();
            foreach ($data['application'] as $getApplications) {
                $applications = $getApplications->application;
                foreach ($applications as $application) {
                    if ($application->status == 0) {
                        array_push($data['countApplications'], $application);
                    }
                }
            }
        
            $data['counter'] = count($data['countApplications']);
            //dd( $data['application']);
            $view->with('counter', $data['counter']);
        }
    }
}
