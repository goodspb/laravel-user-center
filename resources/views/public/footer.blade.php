<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> {{ Config::get('app.version') }}
    </div>
    <strong>Copyright &copy; 2010-{{ date('Y') }} <a href="{{ Config::get('app.url') }}">{{ Setting::get('app_name', '') }}</a>.</strong> All rights
    reserved.
</footer>
