<?php

namespace Lizhineng\Sharable\Tests;

use Lizhineng\Sharable\Share;
use Illuminate\Support\Facades\DB;

class MigrationTest extends TestCase
{
    /** @test */
    public function it_has_shares_table()
    {
        $tableName = config('sharable.table_names.sharings');

        DB::table($tableName)->insert([
            'token' => 'fake-token',
            'sharable_type' => Diary::class,
            'sharable_id' => 1,
            'allows' => 1,
        ]);

        $share = DB::table($tableName)->where('token', 'fake-token')->first();

        $this->assertEquals('fake-token', $share->token);
    }

    /** @test */
    public function it_has_model_has_collaborators_table()
    {
        $tableName = config('sharable.table_names.model_has_collaborators');

        DB::table($tableName)->insert([
            'model_type' => Diary::class,
            'model_id' => 1,
            'user_id' => 1,
        ]);

        $record = DB::table($tableName)->where('user_id', 1)->first();

        $this->assertEquals(1, $record->model_id);
    }
}
