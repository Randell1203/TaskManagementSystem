<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Utilities\ModelRequests;


class ExampleTest extends TestCase
{
    use ModelRequests;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function getRequestList()
    {   
        $dataArray = array('user_type','department');

        $response = $this->json('get', '/getDefaultData',$dataArray)->getContent();


        dd(json_decode($response, true));


        dd($this->getListOfData(['department','job_title']));
        $response->assertStatus(200);
    }

    /** @test */
    public function getJobTitleListByDepartmentId()
    {   
        $dataArray = array(
            'id' => 1
        );

        $response = $this->json('get', '/getJobTitleListByDepartmentId',$dataArray)->getContent();


        dd(json_decode($response, true));


        dd($this->getListOfData(['department','job_title']));
        $response->assertStatus(200);
    }




}
