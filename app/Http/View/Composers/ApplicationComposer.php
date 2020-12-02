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
        //$view->with('count', $this->users->count());
        
        $id = session('User');
        $data['users'] =  \App\Models\User::where('id', $id)->with('company')->first();
    
        if(!empty($data['users']->company[0])){
            $data['count'] = [];
            $data['countApplications'] = [];
            foreach ($data['users']->company as $companyId) {
                $data['applications'] = DB::table('applications')
                ->join('internships', 'internships.id', '=', 'applications.internship_id')
                ->join('companies', 'companies.id', '=', 'applications.companies_id')
                ->join('users', 'users.id', "=" , "companies.user_id")
                ->where('companies.user_id', $id)->get();
            } 
            
            foreach($data['applications'] as $application){
                if($application->status == 0){
                    array_push($data['count'], $application);
                }
            }

            $data['counter'] = count($data['count']);
            $view->with('counter', $data['counter']);
            
        }
                
                
    }
}