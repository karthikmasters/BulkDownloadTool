@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                        <div v-show="this.$root.downloadStatus == ''" v-on:click="initiateDownload()" style="text-decoration: underline; cursor: pointer">
                            Download zip file
                        </div>

                        <div v-show="this.$root.downloadStatus == 'PROGRESS'">
                            Download is in progress <img src="/loader.gif" />
                        </div>

                        <div v-show="this.$root.downloadStatus == 'READY'">
                            Ready to download <a v-bind:href="this.$root.downloadLink" v-text="this.$root.downloadLink">
                            </a>
                        </div>

                        <div v-show="this.$root.downloadStatus == 'ERROR'">
                            Something went wrong!! Unable to download
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
