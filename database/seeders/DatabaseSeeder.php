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
        DB::table('audit_ranks')->insert(
            [
                ['id' => '1', 'title' => 'ビギナー', 'color' => 'green'],
                ['id' => '2', 'title' => 'ブロンズ', 'color' => 'amber'],
                ['id' => '3', 'title' => 'シルバー', 'color' => 'stone'],
                ['id' => '4', 'title' => 'ゴールド', 'color' => 'yellow'],
                ['id' => '5', 'title' => '認定', 'color' => 'gray'],
            ]
        );
        DB::statement("SELECT setval('audit_ranks_id_seq', (SELECT MAX(id) FROM audit_ranks));");

        DB::table('stages')->insert(
            [
                ['id' => '1', 'title' => '企画・構想',],
                ['id' => '2', 'title' => '研究試作',],
                ['id' => '3', 'title' => '設計試作',],
                ['id' => '4', 'title' => '量産試作',],
                ['id' => '5', 'title' => '量産・生産',],
                ['id' => '6', 'title' => '転注',],
                ['id' => '7', 'title' => 'その他',],
            ]
        );
        DB::statement("SELECT setval('stages_id_seq', (SELECT MAX(id) FROM stages));");

        DB::table('methods')->insert(
            [
                ['id' => '1', 'title' => '機械加工（切削・研削等）',],
                ['id' => '2', 'title' => '塑性加工（プレス・鍛造等）',],
                ['id' => '3', 'title' => '鋳造',],
                ['id' => '4', 'title' => '溶接',],
                ['id' => '5', 'title' => '研磨',],
                ['id' => '6', 'title' => '熱処理',],
                ['id' => '7', 'title' => '表面処理',],
                ['id' => '8', 'title' => 'その他',],
            ]
        );
        DB::statement("SELECT setval('methods_id_seq', (SELECT MAX(id) FROM methods));");

        DB::table('audit_item_groups')->insert(
            [
                ['id' => '1', 'title' => '一般'],
                ['id' => '2', 'title' => '経営者'],
                ['id' => '3', 'title' => '経営状態'],
                ['id' => '4', 'title' => '経営環境'],
                ['id' => '5', 'title' => '品質方針'],
                ['id' => '6', 'title' => '品質規定'],
                ['id' => '7', 'title' => '品質管理'],
                ['id' => '8', 'title' => '５S'],
                ['id' => '9', 'title' => '技術'],
                ['id' => '10', 'title' => '環境対策'],
                ['id' => '11', 'title' => 'アンケート'],
            ]
        );
        DB::statement("SELECT setval('audit_item_groups_id_seq', (SELECT MAX(id) FROM audit_item_groups));");

        DB::table('audit_items')->insert(
            [
                ['id' => '1', 'audit_item_group_id' => '1', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '機密事項については入力および添付しないこと約束する'],
                ['id' => '2', 'audit_item_group_id' => '1', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => 'ZOOMが使用できる（マッチング前の面談で活用します）'],
                ['id' => '3', 'audit_item_group_id' => '1', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '自社のホームページを有している'],
                ['id' => '4', 'audit_item_group_id' => '2', 'point' => 3, 'checkbox' => false, 'text' => true, 'evidence' => false, 'template' => '・業界経験：〇〇年以上\n・経営経験：〇〇年以上\n・得意分野：営業/技術/経理/管理　など\n・人物像：まじめ・実行力がある・社交的・個性的　など\n・就任経緯：創業者・同族出向・出向・買収　など', 'title' => '経営者タイプ（業界経験、経営経験、得意分野、就任経緯、人物像を自己記載）'],
                ['id' => '5', 'audit_item_group_id' => '3', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '要望があれば貸借対照表（BS)を提出できる'],
                ['id' => '6', 'audit_item_group_id' => '3', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '要望があれば損益計算書(PL)を提出できる'],
                ['id' => '7', 'audit_item_group_id' => '3', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '要望があればキャッシュフロー計算書（CF）を提出できる'],
                ['id' => '8', 'audit_item_group_id' => '3', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '要望があれば株主資本等変動計算書を提出できる'],
                ['id' => '9', 'audit_item_group_id' => '3', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '要望があれば借入状況を提出できる（銀行取引も併せた試算表）'],
                ['id' => '10', 'audit_item_group_id' => '4', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '労働基準法を守っている'],
                ['id' => '11', 'audit_item_group_id' => '4', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '社会的規範や企業の社会的責任を守るため、『コンプライアンス』を遵守している'],
                ['id' => '12', 'audit_item_group_id' => '4', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => 'ステークホルダーとの良好な関係を築くための施策をしている'],
                ['id' => '13', 'audit_item_group_id' => '5', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '品質方針がある'],
                ['id' => '14', 'audit_item_group_id' => '6', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => 'ISO90001を取得している'],
                ['id' => '15', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '文書管理規定を設けている（図面等の取扱いなど）'],
                ['id' => '16', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '製造管理規定を設けいている（調達から梱包までに関わる規定）'],
                ['id' => '17', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '変更管理規定を設けている（図面変更など）'],
                ['id' => '18', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '計測機器管理規定を設けている（ノギス管理方法など）'],
                ['id' => '19', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '不適合品管理規定を設けている（不良品対応など）'],
                ['id' => '20', 'audit_item_group_id' => '6', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => 'マネジメントレビューを実施している'],
                ['id' => '21', 'audit_item_group_id' => '7', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '測定具は校正している状態のものを使用している'],
                ['id' => '22', 'audit_item_group_id' => '7', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '測定具の校正頻度や方法は決められている（文書化されている）'],
                ['id' => '23', 'audit_item_group_id' => '7', 'point' => 3, 'checkbox' => false, 'text' => true, 'evidence' => false, 'template' => '', 'title' => '部品の品質を確認するための分析機器を記載（外部依頼もOK）'],
                ['id' => '24', 'audit_item_group_id' => '7', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '材料（素材）の置き方や部品の置き方は統一している'],
                ['id' => '25', 'audit_item_group_id' => '8', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '整理が行き届いている（不要なものは捨て、必要なものも状態によって分けられている状態）'],
                ['id' => '26', 'audit_item_group_id' => '8', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '整頓できている（使いやすく並べて、表示できているか）'],
                ['id' => '27', 'audit_item_group_id' => '8', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '清掃できている（綺麗に掃除され、点検までできているか）'],
                ['id' => '28', 'audit_item_group_id' => '8', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '清潔さを保っている（綺麗な状態を続けているか。また、その工夫があるか）'],
                ['id' => '29', 'audit_item_group_id' => '8', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => 'しつけができている（習慣づけができているか）'],
                ['id' => '30', 'audit_item_group_id' => '9', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '機器の取り扱いは標準化されている（マニュアル化等） ➤機器ごと、もしくは製品・部品ごとに作成しているなど'],
                ['id' => '31', 'audit_item_group_id' => '9', 'point' => 1, 'checkbox' => false, 'text' => true, 'evidence' => false, 'template' => '', 'title' => '保有設備機器を記載'],
                ['id' => '32', 'audit_item_group_id' => '9', 'point' => 1, 'checkbox' => false, 'text' => true, 'evidence' => false, 'template' => '・約〇〇～〇〇人', 'title' => '作業員数を記載'],
                ['id' => '33', 'audit_item_group_id' => '9', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => '機器のメンテの頻度、方法は決められている（文書等がある）'],
                ['id' => '34', 'audit_item_group_id' => '9', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => 'ＱＣ工程表を作成できる'],
                ['id' => '35', 'audit_item_group_id' => '9', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '工程FMEAを作成できる'],
                ['id' => '36', 'audit_item_group_id' => '9', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '加工の資格をもっている（加工の資格がいらない場合もチェックをつけて下さい）'],
                ['id' => '37', 'audit_item_group_id' => '9', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '要望があればサンプル品を送ることができる'],
                ['id' => '38', 'audit_item_group_id' => '9', 'point' => 3, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '他社に負けない固有技術やノウハウがある'],
                ['id' => '39', 'audit_item_group_id' => '9', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '技術ノウハウについて、標準化されている（文書化等）'],
                ['id' => '40', 'audit_item_group_id' => '10', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => true, 'template' => '', 'title' => 'ISO14001を取得している'],
                ['id' => '41', 'audit_item_group_id' => '10', 'point' => 2, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '脱炭素化（カーボンニュートラル）について知っている'],
                ['id' => '42', 'audit_item_group_id' => '10', 'point' => 1, 'checkbox' => false, 'text' => true, 'evidence' => false, 'template' => '', 'title' => '上記についての取組みを記載'],
                ['id' => '43', 'audit_item_group_id' => '10', 'point' => 1, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '自社に関連する環境法令をチェックしてください'],
                ['id' => '44', 'audit_item_group_id' => '11', 'point' => 0, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '自社の技術PRや商品訴求のマーケティングに課題を抱えてる'],
                ['id' => '45', 'audit_item_group_id' => '11', 'point' => 0, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '自社の技術、商品開発、クレーム分析に課題を抱えている'],
                ['id' => '46', 'audit_item_group_id' => '11', 'point' => 0, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '脱炭素化等の環境問題について課題を抱えている'],
                ['id' => '47', 'audit_item_group_id' => '11', 'point' => 0, 'checkbox' => true, 'text' => false, 'evidence' => false, 'template' => '', 'title' => '自社の品質管理について課題を抱えている'],
            ]
        );
        DB::statement("SELECT setval('audit_items_id_seq', (SELECT MAX(id) FROM audit_items));");

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

        DB::table('companies')->insert(
            [
                ['id' => 1, 'name' => '株式会社ミラリンク', 'uuid' => Str::uuid(), 'corporate_number' => '9999999999999'],
                ['id' => 2, 'name' => '株式会社AAA', 'uuid' => Str::uuid(), 'corporate_number' => '1234567890123'],
                ['id' => 3, 'name' => '株式会社BBB', 'uuid' => Str::uuid(), 'corporate_number' => '1234567890124'],
            ]
        );
        DB::statement("SELECT setval('companies_id_seq', (SELECT MAX(id) FROM companies));");

        DB::table('users')->insert(
            [
                [
                    'login_id' => 'test12',
                    'uuid' => Str::uuid(),
                    'company_id' => '1',
                    'name' => '佐取　直拓',
                    'email' => 'gothiti09@gmail.com',
                    'password' => bcrypt('Test1234'),
                    'email_verified_at' => now(),
                    'kana' => 'サトウ　ナオヒロ',
                    'sex' => '1',
                    'is_admin' => true,
                    'finish_onboarding_at' => now(),
                ],
                [
                    'login_id' => 'test12',
                    'uuid' => Str::uuid(),
                    'company_id' => '2',
                    'name' => '山田　太郎',
                    'email' => 'user@example.com',
                    'password' => bcrypt('Test1234'),
                    'email_verified_at' => now(),
                    'kana' => 'ヤマダ　タロウ',
                    'sex' => '1',
                    'is_admin' => false,
                    'finish_onboarding_at' => now(),
                ],
                [
                    'login_id' => 'test12',
                    'uuid' => Str::uuid(),
                    'company_id' => '3',
                    'name' => '木村　花子',
                    'email' => 'user2@example.com',
                    'password' => bcrypt('Test1234'),
                    'email_verified_at' => now(),
                    'kana' => 'キムラ　ハナコ',
                    'sex' => '2',
                    'is_admin' => false,
                    'finish_onboarding_at' => now(),
                ],
            ]
        );
        DB::statement("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));");
    }
}
