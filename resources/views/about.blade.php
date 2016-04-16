@extends('app')

@section('content')
    @include('page-header')

    <h1 class="ui header">
        <i class="settings icon"></i>
        <div class="content">
            Overview
            <div class="sub header">The high-level stuff</div>
        </div>
    </h1>
    <div class="ui basic very padded segment">
        <p>RallySearch is an alternative way of consuming Reddit. As Redditors all know, search functionality within the
            site is rather lackluster. This prototype project aims to offer an alternative to browsing Reddit by it's
            content in a visually pleasing and simple fashion.
            <br><br>Top media posts on Reddit are sent through Google's Cloud Vision (Image recognition API) and results
            are
            cached. Upon giving each image (or preview in the case of videos and gifs) labels, users can easily view
            similar
            content by selecting the desired tag(s).
            <br><br>This project is part of a larger project aimed towards generating insights and analytics towards
            Reddit data
            for my undergraduate honours thesis. RallySearch is designed to be slim with limited yet effective
            functionality.</p>
    </div>
    <div class="ui divider"></div>

    <h1 class="ui header">
        <i class="terminal icon"></i>
        <div class="content">
            Contributing
            <div class="sub header">If you're interested in developing</div>
        </div>
    </h1>
    <div class="ui basic very padded segment">
        <ol>
            <li>Fork it</li>
            <li>Create your feature branch: git checkout -b my-new-feature</li>
            <li>Commit your changes: git commit -am 'Add some feature'</li>
            <li>Push to the branch: git push origin my-new-feature</li>
            <li>Submit a pull request</li>
        </ol>
    </div>

    <div class="ui divider"></div>

    <h1 class="ui header">
        <i class="file icon"></i>
        <div class="content">
            License
            <div class="sub header">Permission... Granted</div>
        </div>
    </h1>
    <div class="ui basic very padded segment">
        <p>Rallysearch is open-sourced software licensed under the <a href="http://opensource.org/licenses/MIT">MIT
                license</a>.</p>
    </div>
@endsection