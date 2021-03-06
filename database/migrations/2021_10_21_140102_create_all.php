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
            $table->unsignedBigInteger('audit_rank_id')->default(1);
            $table->boolean('is_admin')->default(false);
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

        Schema::create('user_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $this->addCommonColumn($table);
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->string('corporate_number')->unique()->comment('????????????');
            $table->string('name')->nullable();
            $this->addCommonColumn($table);
        });

        Schema::create('audit_ranks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('color')->default('primary');
            $this->addCommonColumn($table);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('audit_rank_id')->references('id')->on('audit_ranks');
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
            $table->unsignedBigInteger('user_id');
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
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delivery_prefecture_code')->references('code')->on('prefectures');
        });

        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->text('description');
            $table->dateTime('proposal_at');
            $table->dateTime('delivery_at');
            $table->dateTime('request_meeting_at')->nullable();
            $table->dateTime('desired_1_meeting_at')->nullable();
            $table->dateTime('desired_2_meeting_at')->nullable();
            $table->dateTime('desired_3_meeting_at')->nullable();
            $table->dateTime('cancel_at')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->integer('budget')->nullable();
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('user_id')->references('id')->on('users');
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

        Schema::create('audit_item_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $this->addCommonColumn($table);
        });

        Schema::create('audit_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audit_item_group_id');
            $table->string('title');
            $table->integer('point')->nullable();
            $table->boolean('checkbox')->default(false);
            $table->boolean('text')->default(false);
            $table->string('template')->nullable();
            $table->boolean('evidence')->default(false);
            $this->addCommonColumn($table);
            $table->foreign('audit_item_group_id')->references('id')->on('audit_item_groups');
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('point_sum')->nullable();
            $table->integer('point_full')->nullable();
            $table->integer('point_avg')->nullable();
            $table->unsignedBigInteger('audit_rank_id')->nullable();
            $this->addCommonColumn($table);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('audit_rank_id')->references('id')->on('audit_ranks');
        });

        Schema::create('audit_item_group_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('audit_id');
            $table->string('title');
            $this->addCommonColumn($table);
            $table->foreign('audit_id')->references('id')->on('audits');
        });

        Schema::create('audit_item_answers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('audit_item_group_answer_id');
            $table->string('title');
            $table->boolean('checkbox')->default(false);
            $table->boolean('text')->default(false);
            $table->boolean('evidence')->default(false);
            $table->text('answer_text')->nullable();
            $table->boolean('answer_check')->nullable();
            $table->integer('point')->nullable();
            $table->string('evidence_name')->nullable();
            $table->string('evidence_path')->nullable();
            $this->addCommonColumn($table);
            $table->foreign('audit_item_group_answer_id')->references('id')->on('audit_item_group_answers');
        });

        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('project_id');
            $table->string('name');
            $table->string('path');
            $this->addCommonColumn($table);
            $table->foreign('project_id')->references('id')->on('projects');
        });

        Schema::create('proposal_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
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

        Schema::create('request_audits', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('plan');
            $table->text('description');
            $this->addCommonColumn($table);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    private function addCommonColumn($table, $created_by = true)
    {
        $table->softDeletes();
        if ($created_by) {
            // ?????????????????????????????????????????????????????????????????????????????????????????????created_by?????????????????????
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
