@extends('layouts.baseline')
@section('title', 'Braintrainer — benchmark your mind and body')

@section('content')
<div class="page">
    <div style="max-width:620px;margin-bottom:40px">
        <h1 style="font-size:52px;line-height:1.02;letter-spacing:-0.03em;margin:0 0 16px;font-weight:700">Take a break from AI..</h1>
        <p style="font-size:17px;line-height:1.55;color:oklch(0.5 0.02 80);margin:0">Easy and short excercises!</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:16px">
        <a href="/mind" class="card card-hover" style="padding:26px;cursor:pointer;display:flex;flex-direction:column;gap:18px;min-height:250px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between">
                <div style="width:52px;height:52px;border-radius:15px;background:oklch(0.93 0.04 250);color:oklch(0.45 0.14 250);display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:20px;font-weight:600">M</div>
                <div class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">Exercises: 8</div>
            </div>
            <div>
                <div style="font-size:28px;font-weight:700;letter-spacing:-0.02em;margin-bottom:8px">Mind</div>
                <div style="font-size:15px;line-height:1.5;color:oklch(0.5 0.02 80)">Memory, reflexes, attention. Pure screen-and-keyboard tests.</div>
            </div>
            <div class="mono" style="margin-top:auto;display:flex;gap:18px;font-size:12px;color:oklch(0.62 0.02 80)">
            </div>
        </a>

        <a href="/body" class="card card-hover" style="padding:26px;cursor:pointer;display:flex;flex-direction:column;gap:18px;min-height:250px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between">
                <div style="width:52px;height:52px;border-radius:15px;background:oklch(0.93 0.05 40);color:oklch(0.5 0.15 35);display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:20px;font-weight:600">B</div>
                <div class="mono" style="font-size:12px;color:oklch(0.62 0.02 80)">Exercises: 1</div>
            </div>
            <div>
                <div style="font-size:28px;font-weight:700;letter-spacing:-0.02em;margin-bottom:8px">Body</div>
                <div style="font-size:15px;line-height:1.5;color:oklch(0.5 0.02 80)">Rhythm and timing you perform standing up. Jump, hold, balance.</div>
            </div>
            <div class="mono" style="margin-top:auto;display:flex;gap:18px;font-size:12px;color:oklch(0.62 0.02 80)">
            </div>
        </a>
    </div>
</div>
@endsection
