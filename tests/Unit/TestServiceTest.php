<?php

namespace SmNet\LaravelRlf\Tests;


use SmNet\LaravelRlf\Facades\LaravelRlfFacade;
use SmNet\LaravelRlf\Tests\TestCase;

class TestServiceTest extends TestCase
{
    public function test_sum_function(){
        $this->assertEquals(20, LaravelRlfFacade::sum(10,10));
        $this->assertEquals(15, LaravelRlfFacade::sum(7.5,7.5));
    }
    public function test_get_another_text_function(){
        $this->assertIsString(LaravelRlfFacade::getAnotherText());
    }
}