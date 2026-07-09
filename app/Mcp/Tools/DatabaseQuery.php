<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\DB;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;

#[Description('Execute read-only database queries to inspect tables, schemas, and data.')]
class DatabaseQuery extends Tool
{
    public function handle(Request $request): Response
    {
        $query = $request->input('query');

        try {
            $results = DB::select($query);

            return Response::text(json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } catch (\Exception $e) {
            return Response::text('Error: '.$e->getMessage());
        }
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'query' => $schema->string('SQL SELECT query to execute'),
        ];
    }
}
