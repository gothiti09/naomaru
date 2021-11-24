<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Family;
use App\Models\InvitedFamily;
use App\Models\User;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class OnboardingNonResidentParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::getNonResidentParent();
        return view('pages.onboarding-non-resident-parent.create-edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        User::createByRequest($request, User::ROLE_NON_RESIDENT_PARENT);
        return redirect('/')->with('success', '設定しました');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request, User $user)
    {
        $user->resendCreateUserMail();
        return redirect('/')->with('success', '設定しました');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function wait(Request $request)
    {
        Family::find(Auth::user()->company_id)->fill(['inviting_non_resident_parent_at' => now()])->save();
        return redirect('/')->with('success', '設定しました');
    }

    public function download()
    {
        $invited_family = InvitedFamily::firstOrCreate(
            ['company_id' => Auth::user()->company_id],
            ['invited_id' => Str::uuid()]
        );
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data('https://app.raeru.jp/register?invited_id=' . $invited_family->uuid)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(100)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build();
        $dataUri = $result->getDataUri();
        $pdf = PDF::loadView('pages.onboarding-non-resident-parent.generate_pdf', compact('dataUri'));
        return $pdf->stream('title.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->forceDelete();
            return redirect('/onboarding-non-resident-parent')->with('success', '削除しました');
        } catch (Exception $e) {
            return redirect('/onboarding-non-resident-parent')->withErrors('削除できませんでした。お問い合わせください。');
        }
    }
}
