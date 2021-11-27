<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->char('prefecture_code', 2)->nullable();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('audit_level_id')->nullable();
            $table->string('email');
            $table->string('login_id');
            $table->string('name')->nullable();
            $table->string('team_name')->nullable();
            $table->string('kana')->nullable();
            $table->string('age_range')->nullable();
            $table->string('tel')->nullable();
            // https://qiita.com/aoshirobo/items/32deb45cb8c8b87d65a4#%E7%B5%90%E8%AB%96
            $table->string('sex')->default(0)->comment('Not known:0,Male:1,Female:2,Not applicable:9');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('finish_onboarding_at')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->boolean('is_buyer')->default(true);
            $table->string('password');
            $table->rememberToken();
            $this->addCommonColumn($table);
            $table->unique(['email', 'deleted_at'], 'users_email_unique');
            $table->unique(['company_id', 'login_id', 'deleted_at'], 'users_login_id_unique');
        });

        Schema::create('prefectures', function (Blueprint $table) {
            $table->char('code', 2)->primary();
            $table->unsignedBigInteger('region_id');
            $table->string('name', 45)->nullable();
            $this->addCommonColumn($table);
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('corporate_number')->unique()->comment('法人番号');
            $table->string('name')->nullable();
            $this->addCommonColumn($table);
        });

        Schema::create('audit_levels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $this->addCommonColumn($table);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('audit_level_id')->references('id')->on('audit_levels');
            $table->foreign('prefecture_code')->references('code')->on('prefectures');
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $this->addCommonColumn($table, false);
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('company_id');
            $table->char('delivery_prefecture_code', 2);
            $table->string('title');
            $table->text('description');
            $table->string('status')->index();
            $table->dateTime('open_at');
            $table->dateTime('close_at');
            $table->dateTime('desired_delivery_at');
            $table->dateTime('cancel_at')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->integer('min_budget')->nullable();
            $table->integer('max_budget')->nullable();
            $table->boolean('budget_undecided')->default(false);
            $table->boolean('open')->default(true);
            $this->addCommonColumn($table);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('delivery_prefecture_code')->references('code')->on('prefectures');
        });

        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('company_id');
            $table->text('description');
            $table->dateTime('proposal_at');
            $table->dateTime('delivery_at');
            $table->dateTime('request_meeting_at')->nullable();
            $table->dateTime('cancel_at')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->integer('budget')->nullable();
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('company_id')->references('id')->on('companies');
        });

        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $this->addCommonColumn($table);
        });

        Schema::create('methods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $this->addCommonColumn($table);
        });

        Schema::create('audit_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('point');
            $table->boolean('evidence')->default(false);
            $this->addCommonColumn($table);
        });

        Schema::create('user_audits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('status')->index();
            $this->addCommonColumn($table);
        });

        Schema::create('audit_item_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_audit_id');
            $table->unsignedBigInteger('audit_item_id');
            $table->string('title');
            $table->integer('point');
            $table->string('path');
            $this->addCommonColumn($table);
            $table->foreign('user_audit_id')->references('id')->on('user_audits');
            $table->foreign('audit_item_id')->references('id')->on('audit_items');
        });

        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('name');
            $table->string('path');
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
        });

        Schema::create('proposal_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_id');
            $table->string('name');
            $table->string('path');
            $this->addCommonColumn($table);
            $table->foreign('proposal_id')->references('id')->on('proposals');
        });

        Schema::create('project_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('stage_id');
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('stage_id')->references('id')->on('stages');
        });

        Schema::create('project_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('method_id');
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('method_id')->references('id')->on('methods');
        });
    }

    private function addCommonColumn($table, $created_by = true)
    {
        $table->softDeletes();
        if ($created_by) {
            // パスワードリセットなどログインしていない状態でのデータ登録ではcreated_byは登録できない
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
        }
        $table->timestamp('created_at')->useCurrent();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        $table->foreign('updated_by')->references('id')->on('users');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
