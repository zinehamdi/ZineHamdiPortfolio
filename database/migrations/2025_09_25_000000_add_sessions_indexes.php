<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		if (!Schema::hasTable('sessions')) {
			return;
		}

		$hasUserColumn = Schema::hasColumn('sessions', 'user_id');
		$hasLastActivityColumn = Schema::hasColumn('sessions', 'last_activity');

		Schema::table('sessions', function (Blueprint $table) use ($hasUserColumn, $hasLastActivityColumn) {
			if (!$hasUserColumn) {
				return;
			}

			if (!$this->indexExists('sessions', 'sessions_user_id_index')) {
				$table->index('user_id', 'sessions_user_id_index');
			}

			if ($hasLastActivityColumn && !$this->indexExists('sessions', 'sessions_user_last_activity_index')) {
				$table->index(['user_id', 'last_activity'], 'sessions_user_last_activity_index');
			}

			if ($hasLastActivityColumn && !$this->indexExists('sessions', 'sessions_last_activity_index')) {
				$table->index('last_activity', 'sessions_last_activity_index');
			}
		});
	}

	public function down(): void
	{
		if (!Schema::hasTable('sessions')) {
			return;
		}

		Schema::table('sessions', function (Blueprint $table) {
			if ($this->indexExists('sessions', 'sessions_user_id_index')) {
				$table->dropIndex('sessions_user_id_index');
			}

			if ($this->indexExists('sessions', 'sessions_user_last_activity_index')) {
				$table->dropIndex('sessions_user_last_activity_index');
			}

			if ($this->indexExists('sessions', 'sessions_last_activity_index')) {
				$table->dropIndex('sessions_last_activity_index');
			}
		});
	}

	private function indexExists(string $table, string $index): bool
	{
		$connection = Schema::getConnection();
		$tableName = $connection->getTablePrefix() . $table;
		$driver = $connection->getDriverName();

		if ($driver === 'sqlite') {
			$escapedTable = str_replace("'", "''", $tableName);
			$rows = $connection->select("PRAGMA index_list('{$escapedTable}')");

			foreach ($rows as $row) {
				$name = is_array($row) ? ($row['name'] ?? null) : ($row->name ?? null);
				if ($name === $index) {
					return true;
				}
			}

			return false;
		}

		if ($driver === 'mysql') {
			$escapedTable = str_replace('`', '``', $tableName);
			$rows = $connection->select("SHOW INDEX FROM `{$escapedTable}` WHERE Key_name = ?", [$index]);

			return !empty($rows);
		}

		if ($driver === 'pgsql') {
			$schema = $connection->getConfig('schema') ?? 'public';
			$rows = $connection->select('SELECT indexname FROM pg_indexes WHERE schemaname = ? AND tablename = ? AND indexname = ?', [$schema, $tableName, $index]);

			return !empty($rows);
		}

		if ($driver === 'sqlsrv') {
			$rows = $connection->select('SELECT name FROM sys.indexes WHERE object_id = OBJECT_ID(?) AND name = ?', [$tableName, $index]);

			return !empty($rows);
		}

		return false;
	}
};
