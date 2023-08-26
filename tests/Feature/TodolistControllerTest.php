<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "budi",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Marcell"
                ],
                [
                    "id" => "2",
                    "todo" => "Budi"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Marcell")
            ->assertSeeText("2")
            ->assertSeeText("Budi");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "budi"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "budi"
        ])->post("/todolist", [
            "todo" => "Marcell"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "budi",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Marcell"
                ],
                [
                    "id" => "2",
                    "todo" => "Putra"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
