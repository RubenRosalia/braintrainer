@extends('layouts.baseline')
@section('title', $game['name'] . ' — Braintrainer')

@section('content')
<div class="page" style="max-width:640px">
    <a href="/{{ $category }}" class="back">&larr; Back to Exercises</a>
    <div class="card" style="padding:44px 34px;text-align:center;display:flex;flex-direction:column;align-items:center;gap:18px">
        <div class="mono" style="width:66px;height:66px;border-radius:19px;background:oklch(0.95 0.02 250);color:oklch(0.48 0.13 250);display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:600">{{ $game['mark'] }}</div>
        <div style="font-size:26px;font-weight:700;letter-spacing:-0.02em">{{ $game['name'] }}</div>
        <div style="font-size:16px;line-height:1.55;color:oklch(0.5 0.02 80);max-width:380px">{{ $game['desc'] }}</div>
        <div class="mono" style="font-size:12px;letter-spacing:0.12em;text-transform:uppercase;color:oklch(0.64 0.02 80);border:1px dashed oklch(0.86 0.01 90);border-radius:999px;padding:8px 16px">Coming soon</div>
        <div style="display:flex;gap:10px;margin-top:6px">
            <a href="/games/number" class="btn" style="font-size:15px;padding:12px 26px">Play Number Memory</a>
            <a href="/games/reaction" class="btn btn-ghost" style="font-size:15px;padding:12px 26px">Reaction Time</a>
        </div>
    </div>
</div>
@endsection
