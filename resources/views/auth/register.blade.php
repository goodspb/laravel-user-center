@extends('layouts.auth')

@section('title') {{ trans('auth.register') }} @endsection

@section('css')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ Config::get('app.cdn_url') }}plugins/iCheck/square/blue.css">
@endsection

@section('body-class') hold-transition register-page @endsection

@section('content')
    <?php $appName = Config::get('app.name'); ?>
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/') }}"><b>{{ $appName }}</b>{{ trans('auth.register') }}</a>
        </div>

        <div class="register-box-body">
            @include('public/message')
            <form action="{{ url('auth/register') }}" method="post">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="{{ trans('auth.email') }}" name="email"
                           value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="{{ trans('auth.password') }}"
                           name="password" value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="{{ trans('auth.repeat-password') }}"
                           name="password_confirmation" value="">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="terms"
                                       @if(old('terms', 0)) checked @endif> {{ trans('auth.agree') }}
                                <a href="#" data-toggle="modal" data-target="#terms">{{ trans('auth.terms') }}</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        {{ csrf_field() }}
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">{{ trans('auth.register-btn') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <a href="{{ url('auth/login') }}" class="pull-left">{{ trans('auth.login') }}</a>
            <br>
        </div>
    </div>

    <!-- 注册条款 -->
    <div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="terms">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('auth.terms') }}</h4>
                </div>
                <div class="modal-body">
                    <h4>{{ $appName }}用户注册协议</h4>

                    <p> 本协议是您与{{ $appName }}网站（简称&quot;本站&quot;，网址：{{ Config::get('app.url') }}）所有者（以下简称为&quot;{{ $appName }}&quot;）之间就{{ $appName }}网站服务等相关事宜所订立的契约，请您仔细阅读本注册协议，您点击&quot;同意并继续&quot;按钮后，本协议即构成对双方有约束力的法律文件。</p>
                    <h5> 第1条 本站服务条款的确认和接纳</h5>

                    <p><strong>1.1</strong>本站的各项电子服务的所有权和运作权归{{ $appName }}所有。用户同意所有注册协议条款并完成注册程序，才能成为本站的正式用户。用户确认：本协议条款是处理双方权利义务的契约，始终有效，法律另有强制性规定或双方另有特别约定的，依其规定。
                    </p>

                    <p><strong>1.2</strong>用户点击同意本协议的，即视为用户确认自己具有享受本站服务、下单购物等相应的权利能力和行为能力，能够独立承担法律责任。</p>

                    <p><strong>1.3</strong>如果您在18周岁以下，您只能在父母或监护人的监护参与下才能使用本站。</p>

                    <p><strong>1.4</strong>{{ $appName }}保留在中华人民共和国大陆地区法施行之法律允许的范围内独自决定拒绝服务、关闭用户账户、清除或编辑内容或取消订单的权利。</p>
                    <h5> 第2条 本站服务</h5>

                    <p><strong>2.1</strong>{{ $appName }}通过互联网依法为用户提供互联网信息等服务，用户在完全同意本协议及本站规定的情况下，方有权使用本站的相关服务。</p>

                    <p><strong>2.2</strong>用户必须自行准备如下设备和承担如下开支：（1）上网设备，包括并不限于电脑或者其他上网终端、调制解调器及其他必备的上网装置；（2）上网开支，包括并不限于网络接入费、上网设备租用费、手机流量费等。
                    </p>
                    <h5> 第3条 用户信息</h5>

                    <p><strong>3.1</strong>用户应自行诚信向本站提供注册资料，用户同意其提供的注册资料真实、准确、完整、合法有效，用户注册资料如有变动的，应及时更新其注册资料。如果用户提供的注册资料不合法、不真实、不准确、不详尽的，用户需承担因此引起的相应责任及后果，并且{{ $appName }}保留终止用户使用{{ $appName }}各项服务的权利。
                    </p>

                    <p><strong>3.2</strong>用户在本站进行浏览、下单购物等活动时，涉及用户真实姓名/名称、通信地址、联系电话、电子邮箱等隐私信息的，本站将予以严格保密，除非得到用户的授权或法律另有规定，本站不会向外界披露用户隐私信息。
                    </p>

                    <p><strong>3.3</strong>用户注册成功后，将产生用户名和密码等账户信息，您可以根据本站规定改变您的密码。用户应谨慎合理的保存、使用其用户名和密码。用户若发现任何非法使用用户账号或存在安全漏洞的情况，请立即通知本站并向公安机关报案。
                    </p>

                    <p><strong>3.4</strong><strong>用户同意，{{ $appName }}拥有通过邮件、短信电话等形式，向在本站注册、购物用户、收货人发送订单信息、促销活动等告知信息的权利。</strong>
                    </p>

                    <p><strong>3.5</strong><strong>用户不得将在本站注册获得的账户借给他人使用，否则用户应承担由此产生的全部责任，并与实际使用人承担连带责任。</strong></p>

                    <p>
                        <strong>3.6</strong><strong>用户同意，{{ $appName }}有权使用用户的注册信息、用户名、密码等信息，登录进入用户的注册账户，进行证据保全，包括但不限于公证、见证等。</strong>
                    </p>
                    <h5> 第4条 用户依法言行义务</h5>

                    <p> 本协议依据国家相关法律法规规章制定，用户同意严格遵守以下义务：</p>

                    <p><strong>（1）</strong>不得传输或发表：煽动抗拒、破坏宪法和法律、行政法规实施的言论，煽动颠覆国家政权，推翻社会主义制度的言论，煽动分裂国家、破坏国家统一的的言论，煽动民族仇恨、民族歧视、破坏民族团结的言论；
                    </p>

                    <p><strong>（2）</strong>从中国大陆向境外传输资料信息时必须符合中国有关法规；</p>

                    <p><strong>（3）</strong>不得利用本站从事洗钱、窃取商业秘密、窃取个人信息等违法犯罪活动； </p>

                    <p><strong>（4）</strong>不得干扰本站的正常运转，不得侵入本站及国家计算机信息系统；</p>

                    <p><strong>（5）</strong>不得传输或发表任何违法犯罪的、骚扰性的、中伤他人的、辱骂性的、恐吓性的、伤害性的、庸俗的，淫秽的、不文明的等信息资料；</p>

                    <p><strong>（6）</strong>不得传输或发表损害国家社会公共利益和涉及国家安全的信息资料或言论；</p>

                    <p><strong>（7）</strong>不得教唆他人从事本条所禁止的行为；</p>

                    <p><strong>（8）</strong>不得利用在本站注册的账户进行牟利性经营活动；</p>

                    <p><strong>（9）</strong>不得发布任何侵犯他人著作权、商标权等知识产权或合法权利的内容；</p>

                    <p> 用户应不时关注并遵守本站不时公布或修改的各类合法规则规定。</p>

                    <p><strong>本站保有删除站内各类不符合法律政策或不真实的信息内容而无须通知用户的权利。</strong></p>

                    <p><strong>若用户未遵守以上规定的，本站有权作出独立判断并采取暂停或关闭用户帐号等措施。</strong>用户须对自己在网上的言论和行为承担法律责任。</p>
                    <h5> 第5条 所有权及知识产权条款</h5>

                    <p><strong>5.1</strong><strong>用户一旦接受本协议，即表明该用户主动将其在任何时间段在本站发表的任何形式的信息内容（包括但不限于客户评价、客户咨询、各类话题文章等信息内容）的财产性权利等任何可转让的权利，如著作权财产权（包括并不限于：复制权、发行权、出租权、展览权、表演权、放映权、广播权、信息网络传播权、摄制权、改编权、翻译权、汇编权以及应当由著作权人享有的其他可转让权利），全部独家且不可撤销地转让给{{ $appName }}所有，用户同意{{ $appName }}有权就任何主体侵权而单独提起诉讼。</strong>
                    </p>

                    <p><strong>5.2</strong><strong>本协议已经构成《中华人民共和国著作权法》第二十五条（条文序号依照2011年版著作权法确定）及相关法律规定的著作财产权等权利转让书面协议，其效力及于用户在{{ $appName }}网站上发布的任何受著作权法保护的作品内容，无论该等内容形成于本协议订立前还是本协议订立后。</strong>
                    </p>

                    <p>
                        <strong>5.3</strong><strong>用户同意并已充分了解本协议的条款，承诺不将已发表于本站的信息，以任何形式发布或授权其它主体以任何方式使用（包括但不限于在各类网站、媒体上使用）。</strong>
                    </p>

                    <p><strong>5.4</strong><strong>{{ $appName }}是本站的制作者,拥有此网站内容及资源的著作权等合法权利,受国家法律保护,有权不时地对本协议及本站的内容进行修改，并在本站张贴，无须另行通知用户。在法律允许的最大限度范围内，{{ $appName }}对本协议及本站内容拥有解释权。</strong>
                    </p>

                    <p><strong>5.5</strong><strong>除法律另有强制性规定外，未经{{ $appName }}明确的特别书面许可,任何单位或个人不得以任何方式非法地全部或部分复制、转载、引用、链接、抓取或以其他方式使用本站的信息内容，否则，{{ $appName }}有权追究其法律责任。</strong>
                    </p>

                    <p><strong>5.6</strong>本站所刊登的资料信息（诸如文字、图表、标识、按钮图标、图像、声音文件片段、数字下载、数据编辑和软件），均是{{ $appName }}或其内容提供者的财产，受中国和国际版权法的保护。本站上所有内容的汇编是{{ $appName }}的排他财产，受中国和国际版权法的保护。本站上所有软件都是{{ $appName }}或其关联公司或其软件供应商的财产，受中国和国际版权法的保护。
                    </p>
                    <h5> 第6条 责任限制及不承诺担保</h5>

                    <p><strong>除非另有明确的书面说明,本站及其所包含的或以其它方式通过本站提供给您的全部信息、内容、材料、产品（包括软件）和服务，均是在&quot;按现状&quot;和&quot;按现有&quot;的基础上提供的。</strong>
                    </p>

                    <p>
                        <strong>除非另有明确的书面说明,{{ $appName }}不对本站的运营及其包含在本网站上的信息、内容、材料、产品（包括软件）或服务作任何形式的、明示或默示的声明或担保（根据中华人民共和国法律另有规定的以外）。</strong>
                    </p>

                    <p><strong>{{ $appName }}不担保本站所包含的或以其它方式通过本站提供给您的全部信息、内容、材料、产品（包括软件）和服务、其服务器或从本站发出的电子信件、信息没有病毒或其他有害成分。</strong>
                    </p>

                    <p><strong>如因不可抗力或其它本站无法控制的原因使本站销售系统崩溃或无法正常使用导致网上交易无法完成或丢失有关的信息、记录等，{{ $appName }}会合理地尽力协助处理善后事宜。</strong></p>
                    <h5> 第7条 协议更新及用户关注义务</h5>
                    根据国家法律法规变化及网站运营需要，{{ $appName }}有权对本协议条款不时地进行修改，修改后的协议一旦被张贴在本站上即生效，并代替原来的协议。用户可随时登录查阅最新协议；
                    <strong><em>用户有义务不时关注并阅读最新版的协议及网站公告。如用户不同意更新后的协议，可以且应立即停止接受{{ $appName }}网站依据本协议提供的服务；如用户继续使用本网站提供的服务的，即视为同意更新后的协议。{{ $appName }}建议您在使用本站之前阅读本协议及本站的公告。</em></strong>
                    如果本协议中任何一条被视为废止、无效或因任何理由不可执行，该条应视为可分的且并不影响任何其余条款的有效性和可执行性。
                    <h5> 第8条 法律管辖和适用</h5> 本协议的订立、执行和解释及争议的解决均应适用在中华人民共和国大陆地区适用之有效法律（但不包括其冲突法规则）。
                    如发生本协议与适用之法律相抵触时，则这些条款将完全按法律规定重新解释，而其它有效条款继续有效。
                    如缔约方就本协议内容或其执行发生任何争议，双方应尽力友好协商解决；协商不成时，任何一方均可向有管辖权的中华人民共和国大陆地区法院提起诉讼。
                    <h5> 第9条 其他 </h5>

                    <p><strong>9.1</strong>{{ $appName }}网站所有者是指在政府部门依法许可或备案的{{ $appName }}网站经营主体。</p>

                    <p><strong>9.2</strong>{{ $appName }}尊重用户和消费者的合法权利，本协议及本网站上发布的各类规则、声明等其他内容，均是为了更好的、更加便利的为用户和消费者提供服务。本站欢迎用户和社会各界提出意见和建议，{{ $appName }}将虚心接受并适时修改本协议及本站上的各类规则。
                    </p>

                    <p><strong>9.3</strong><span>本协议内容中以黑体、加粗、下划线、斜体等方式显著标识的条款，请用户着重阅读。</span></p>

                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ trans('common.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- iCheck -->
    <script src="{{ Config::get('app.cdn_url') }}plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection
