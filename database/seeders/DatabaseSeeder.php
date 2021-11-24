<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('audit_levels')->insert(
            [
                ['id' => '1', 'title' => 'ビギナー',],
                ['id' => '2', 'title' => 'ブロンズ',],
                ['id' => '3', 'title' => 'シルバー',],
                ['id' => '4', 'title' => 'ゴールド',],
                ['id' => '5', 'title' => '認定',],
            ]
        );

        DB::table('stages')->insert(
            [
                ['id' => '1', 'title' => '研究試作',],
                ['id' => '2', 'title' => '設計試作',],
                ['id' => '3', 'title' => '量産試作',],
                ['id' => '4', 'title' => '量産',],
                ['id' => '5', 'title' => '転注',],
            ]
        );

        DB::table('methods')->insert(
            [
                ['id' => '1', 'title' => 'プレス',],
                ['id' => '2', 'title' => '切削',],
                ['id' => '3', 'title' => '曲げ',],
                ['id' => '4', 'title' => '鋳造',],
                ['id' => '5', 'title' => '鍛造',],
            ]
        );

        DB::table('audit_items')->insert(
            [
                ['id' => '1', 'point' => 3, 'evidence' => false, 'title' => '機密事項については入力および添付しないこと約束する'],
                ['id' => '2', 'point' => 3, 'evidence' => false, 'title' => 'ZOOMが使用できる（マッチング前の面談で活用します）'],
                ['id' => '3', 'point' => 3, 'evidence' => true, 'title' => '自社のホームページを有している'],
                ['id' => '4', 'point' => 1, 'evidence' => false, 'title' => '株主資本等変動計算書がある'],
                ['id' => '5', 'point' => 1, 'evidence' => true, 'title' => '要望があれば貸借対照表（BS)を提出できる'],
                ['id' => '6', 'point' => 1, 'evidence' => true, 'title' => '要望があれば損益計算書(PL)を提出できる'],
                ['id' => '7', 'point' => 1, 'evidence' => true, 'title' => '要望があればキャッシュフロー計算書（CF）を提出できる'],
                ['id' => '8', 'point' => 1, 'evidence' => true, 'title' => '要望があれば株主資本等変動計算書を提出できる'],
                ['id' => '9', 'point' => 3, 'evidence' => false, 'title' => '労働基準法を守っている'],
                ['id' => '10', 'point' => 3, 'evidence' => false, 'title' => '社会的規範や企業の社会的責任を守るため、『コンプライアンス』を遵守している'],
                ['id' => '11', 'point' => 3, 'evidence' => false, 'title' => 'ステークホルダーとの良好な関係を築くための施策をしている'],
                ['id' => '12', 'point' => 2, 'evidence' => false, 'title' => '品質方針がある'],
                ['id' => '13', 'point' => 1, 'evidence' => true, 'title' => 'ISO90001を取得している'],
                ['id' => '14', 'point' => 2, 'evidence' => false, 'title' => '文書管理規定を設けている（図面等の取扱いなど）'],
                ['id' => '15', 'point' => 2, 'evidence' => false, 'title' => '製造管理規定を設けいている（調達から梱包までに関わる規定）'],
                ['id' => '16', 'point' => 2, 'evidence' => false, 'title' => '変更管理規定を設けている（図面変更など）'],
                ['id' => '17', 'point' => 2, 'evidence' => false, 'title' => '計測機器管理規定を設けている（ノギス管理方法など）'],
                ['id' => '18', 'point' => 2, 'evidence' => false, 'title' => '不適合品管理規定を設けている（不良品対応など）'],
                ['id' => '19', 'point' => 2, 'evidence' => false, 'title' => 'マネジメントレビューを実施している'],
                ['id' => '20', 'point' => 3, 'evidence' => false, 'title' => '測定具は校正している状態のものを使用している'],
                ['id' => '21', 'point' => 2, 'evidence' => true, 'title' => '測定具の校正頻度や方法は決められている（文書化されている）'],
                ['id' => '22', 'point' => 3, 'evidence' => true, 'title' => '部品の品質を確認するための分析機器がある（外部依頼もOK）'],
                ['id' => '23', 'point' => 2, 'evidence' => true, 'title' => '材料（素材）の置き方や部品の置き方は統一している'],
                ['id' => '24', 'point' => 3, 'evidence' => false, 'title' => '整理が行き届いている（不要なものは捨て、必要なものも状態によって分けられている状態）'],
                ['id' => '25', 'point' => 3, 'evidence' => false, 'title' => '整頓できている（使いやすく並べて、表示できているか）'],
                ['id' => '26', 'point' => 3, 'evidence' => false, 'title' => '清掃できている（綺麗に掃除され、点検までできているか）'],
                ['id' => '27', 'point' => 3, 'evidence' => false, 'title' => '清潔さを保っている（綺麗な状態を続けているか。また、その工夫があるか）'],
                ['id' => '28', 'point' => 3, 'evidence' => false, 'title' => 'しつけができている（習慣づけができているか）'],
                ['id' => '29', 'point' => 1, 'evidence' => false, 'title' => '機器の取り扱いは標準化されている（マニュアル化等） ➤機器ごと、もしくは製品・部品ごとに作成しているなど'],
                ['id' => '30', 'point' => 2, 'evidence' => true, 'title' => '機器のメンテの頻度、方法は決められている（文書等がある）'],
                ['id' => '31', 'point' => 1, 'evidence' => false, 'title' => 'ＱＣ工程表を作成できる'],
                ['id' => '32', 'point' => 1, 'evidence' => false, 'title' => '工程FMEAを作成できる'],
                ['id' => '33', 'point' => 3, 'evidence' => false, 'title' => '加工の資格をもっている（加工の資格がいらない場合もチェックをつけて下さい）'],
                ['id' => '34', 'point' => 3, 'evidence' => false, 'title' => '要望があればサンプル品を送ることができる'],
                ['id' => '35', 'point' => 3, 'evidence' => false, 'title' => '他社に負けない固有技術やノウハウがある'],
                ['id' => '36', 'point' => 1, 'evidence' => false, 'title' => '技術ノウハウについて、標準化されている（文書化等）'],
                ['id' => '37', 'point' => 1, 'evidence' => true, 'title' => 'ISO14001を取得している'],
                ['id' => '38', 'point' => 2, 'evidence' => false, 'title' => '脱炭素化（カーボンニュートラル）について知っている'],
                ['id' => '39', 'point' => 1, 'evidence' => false, 'title' => '上記についての取組みを実施している'],
                ['id' => '40', 'point' => 1, 'evidence' => false, 'title' => '自社に関連する環境法令をチェックしてください'],
                ['id' => '41', 'point' => 0, 'evidence' => false, 'title' => '自社の技術PRや商品訴求のマーケティングに課題を抱えてる'],
                ['id' => '42', 'point' => 0, 'evidence' => false, 'title' => '自社の技術、商品開発、クレーム分析に課題を抱えている'],
                ['id' => '43', 'point' => 0, 'evidence' => false, 'title' => '脱炭素化等の環境問題について課題を抱えている'],
                ['id' => '44', 'point' => 0, 'evidence' => false, 'title' => '自社の品質管理について課題を抱えている'],
            ]
        );

        \DB::table('prefectures')->insert([
            ['code' => '01', 'region_id' => 1, 'name' => '北海道'],
            ['code' => '02', 'region_id' => 2, 'name' => '青森県'],
            ['code' => '03', 'region_id' => 2, 'name' => '岩手県'],
            ['code' => '04', 'region_id' => 2, 'name' => '宮城県'],
            ['code' => '05', 'region_id' => 2, 'name' => '秋田県'],
            ['code' => '06', 'region_id' => 2, 'name' => '山形県'],
            ['code' => '07', 'region_id' => 2, 'name' => '福島県'],
            ['code' => '08', 'region_id' => 3, 'name' => '茨城県'],
            ['code' => '09', 'region_id' => 3, 'name' => '栃木県'],
            ['code' => '10', 'region_id' => 3, 'name' => '群馬県'],
            ['code' => '11', 'region_id' => 4, 'name' => '埼玉県'],
            ['code' => '12', 'region_id' => 4, 'name' => '千葉県'],
            ['code' => '13', 'region_id' => 4, 'name' => '東京都'],
            ['code' => '14', 'region_id' => 4, 'name' => '神奈川県'],
            ['code' => '15', 'region_id' => 5, 'name' => '新潟県'],
            ['code' => '16', 'region_id' => 5, 'name' => '富山県'],
            ['code' => '17', 'region_id' => 5, 'name' => '石川県'],
            ['code' => '18', 'region_id' => 5, 'name' => '福井県'],
            ['code' => '19', 'region_id' => 3, 'name' => '山梨県'],
            ['code' => '20', 'region_id' => 3, 'name' => '長野県'],
            ['code' => '21', 'region_id' => 6, 'name' => '岐阜県'],
            ['code' => '22', 'region_id' => 6, 'name' => '静岡県'],
            ['code' => '23', 'region_id' => 6, 'name' => '愛知県'],
            ['code' => '24', 'region_id' => 6, 'name' => '三重県'],
            ['code' => '25', 'region_id' => 7, 'name' => '滋賀県'],
            ['code' => '26', 'region_id' => 7, 'name' => '京都府'],
            ['code' => '27', 'region_id' => 7, 'name' => '大阪府'],
            ['code' => '28', 'region_id' => 7, 'name' => '兵庫県'],
            ['code' => '29', 'region_id' => 7, 'name' => '奈良県'],
            ['code' => '30', 'region_id' => 7, 'name' => '和歌山県'],
            ['code' => '31', 'region_id' => 8, 'name' => '鳥取県'],
            ['code' => '32', 'region_id' => 8, 'name' => '島根県'],
            ['code' => '33', 'region_id' => 8, 'name' => '岡山県'],
            ['code' => '34', 'region_id' => 8, 'name' => '広島県'],
            ['code' => '35', 'region_id' => 8, 'name' => '山口県'],
            ['code' => '36', 'region_id' => 9, 'name' => '徳島県'],
            ['code' => '37', 'region_id' => 9, 'name' => '香川県'],
            ['code' => '38', 'region_id' => 9, 'name' => '愛媛県'],
            ['code' => '39', 'region_id' => 9, 'name' => '高知県'],
            ['code' => '40', 'region_id' => 10, 'name' => '福岡県'],
            ['code' => '41', 'region_id' => 10, 'name' => '佐賀県'],
            ['code' => '42', 'region_id' => 10, 'name' => '長崎県'],
            ['code' => '43', 'region_id' => 10, 'name' => '熊本県'],
            ['code' => '44', 'region_id' => 10, 'name' => '大分県'],
            ['code' => '45', 'region_id' => 10, 'name' => '宮崎県'],
            ['code' => '46', 'region_id' => 10, 'name' => '鹿児島県'],
            ['code' => '47', 'region_id' => 10, 'name' => '沖縄県'],
        ]);
    }
}
