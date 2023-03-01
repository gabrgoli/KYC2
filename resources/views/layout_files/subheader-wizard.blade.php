<div class="row">
    <div class="col-md-6 col-sm-6">
        <h1>{{ $dbProduct?->name }}</h1>
    </div>
    <div class="col-md-6 col-sm-6 text-end">
        @if ($view_name == env('STEP1'))
            <div class="steps">
                <div class="stepActive">
                    <h1>{{ env('STEP1') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP2') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP3') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP4') }}</h1>
                </div>
            </div>
        @elseif ($view_name == env('STEP2'))
            <div class="steps">
                <div class="stepActive">
                    <h1>{{ env('STEP1') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP2') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP3') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP4') }}</h1>
                </div>
            </div>
        @elseif ($view_name == env('STEP3'))
            <div class="steps">
                <div class="stepActive">
                    <h1>{{ env('STEP1') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP2') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP3') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepDisable">
                    <h1>{{ env('STEP4') }}</h1>
                </div>
            </div>
        @elseif ($view_name == env('FINISH'))
            <div class="steps">
                <div class="stepActive">
                    <h1>{{ env('STEP1') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP2') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP3') }}</h1>
                </div>
                <div class="lineStep"></div>
                <div class="stepActive">
                    <h1>{{ env('STEP4') }}</h1>
                </div>
            </div>
        @else
        @endif
    </div>
</div>
