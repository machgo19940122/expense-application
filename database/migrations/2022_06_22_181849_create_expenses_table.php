<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('user_id')->index()->comment('userテーブルと紐づく');
            $table->date('target_date')->index()->comment('経費使用日');
            $table->integer('status')->index()->comment('0=未承認,1=差戻し,2=承認');
            $table->string('name', 100)->index();
            $table->integer('expense')->index()->comment('使用経費金額');
            $table->integer('classification_id')->index()->comment('使用区分,classificationsと紐づく');
            $table->string('expelnation', 30)->index()->comment('経費の説明(支払い先:ゴルフ場など)');
            $table->string('remarks', 30)->index()->comment('備考欄');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
