@extends('layouts.email')

@section('content')
    <h3 class="header-sm" style="
            font-size:22px;
            color: white;
            text-align: center;
            text-transform: uppercase;
            background: #0470ad;
            margin-top: -50px;
            padding-bottom: 20px;
            border-radius: 10px;
            ">RESET PASSWORD </h3>
    <table width="100%" cellpadding="0" cellspacing="0"
           style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
            <td class="content-block"
                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                valign="top">
                <br>
                Hello <b>{{ strtoupper($user->first_name) }}</b>,
            </td>
        </tr>
    </table>
    <table class="stripped" style="border-spacing: 0 1rem; border-collapse: separate">
        <tr class="status-table">
            <td>You requested to reset your password on Calla Charm. Click the link below to reset
                your password.
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; box-sizing: border-box; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: center; padding: 40px 20px">
                <a href="{{ $link }}"
                    style="text-decoration: none; color: #fff; font-weight: bold; outline: none; padding: 15px 30px; background-color: #2D9CDB; text-align: center; border-radius: 10px; box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3)">
                    RESET PASSWORD
                </a>
            </td>
        </tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0"
           style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

        <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
            <td class="content-block"
                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px; float: right"
                valign="top">
                <i>-Calla Charm</i>
            </td>
        </tr>
    </table>
@stop
