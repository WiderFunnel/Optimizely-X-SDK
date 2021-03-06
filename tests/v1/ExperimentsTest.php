<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;

/**
 * Class ExperimentsTest
 */
class ExperimentsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_experiments_in_a_project()
    {
        $client = $this->fakeClient('experiments/experiments');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiments = $optimizely->project('1')->experiments()->all();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Collections\ExperimentCollection::class, $experiments);
        $this->assertObjectHasAttribute('items', $experiments);
        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiments->first());
        $this->assertObjectHasAttribute('id', $experiments->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiments'), $experiments->toJson());
    }

    /** @test */
    public function it_can_fetch_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->find();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_create_an_experiment_in_a_project()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment =   $optimizely->project('1')->experiments()->create(
                            'my testing experiment', 
                            [
                                [
                                    "name" => "control",
                                    "weight" => 5000
                                ],
                                [
                                    "name" => "varA",
                                    "weight" => 5000
                                ]
                            ],
                            [
                                [
                                    "aggregator" => "unique",
                                    "event_id" => 0,
                                    "field" => "revenue"
                                ]
                            ],
                            ['status' => 'not started']
                        );

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_update_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->update([
            'description' => 'Wordpress: 10 Reasons Why Your Agency Should Offer Optimization '
        ]);

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_archive_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->archive();

        $this->assertTrue($experiment);
    }

    /** @test */
    public function it_can_unarchive_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->unarchive();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_publish_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->publish();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_start_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->start();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_complete_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->complete();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_resume_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->resume();

        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_delete_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $experiment = $optimizely->experiment('1')->delete();

        $this->assertTrue($experiment);
    }

    /** @test */
    public function it_can_fetch_an_experiment_results()
    {
        $client = $this->fakeClient('results/results');

        $optimizely = new \WiderFunnel\OptimizelyX($client);
        $results = $optimizely->experiment('1')->results();
        
        $this->assertInstanceOf(\WiderFunnel\OptimizelyX\Items\Results::class, $results);
        $this->assertObjectHasAttribute('start_time', $results);
        $this->assertObjectHasAttribute('end_time', $results);
        $this->assertObjectHasAttribute('metrics', $results);
        // $this->assertJsonStringEqualsJsonFile($this->getStub('results/results'), $results->toJson());
    }

}