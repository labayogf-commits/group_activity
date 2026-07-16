<?php

it('shows the johnmar crud page and supports edit and delete actions', function () {
    $response = $this->get('/johnmar-crud');

    $response->assertStatus(200)
        ->assertSee('Johnmar CRUD')
        ->assertSee('Menu');

    $storeResponse = $this->post('/johnmar-crud', [
        'name' => 'Sample Item',
        'description' => 'A sample record',
        'status' => 'Pending',
    ]);

    $storeResponse->assertRedirect('/johnmar-crud');
    $this->assertTrue(session()->has('success'));

    $editPage = $this->get('/johnmar-crud/1/edit');
    $editPage->assertStatus(200)
        ->assertSee('Update Item');

    $updateResponse = $this->put('/johnmar-crud/1', [
        'name' => 'Updated Item',
        'description' => 'Updated record',
        'status' => 'Done',
    ]);

    $updateResponse->assertRedirect('/johnmar-crud');

    $this->get('/johnmar-crud')
        ->assertSee('Updated Item');

    $deleteResponse = $this->delete('/johnmar-crud/1');
    $deleteResponse->assertRedirect('/johnmar-crud');

    $this->get('/johnmar-crud')
        ->assertDontSee('Updated Item');
});
