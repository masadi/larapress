<!-- BEGIN: Footer-->
<footer class="footer {{($configData['mainLayoutType'] == 'vertical') ? 'footer-light' : 'bg-black text-light'}} {{($configData['footerType'] === 'footer-hidden') ? 'd-none':''}} {{$configData['footerType']}}">
  <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy;
      <script>document.write(new Date().getFullYear())</script><a class="ms-25 {{($configData['mainLayoutType'] == 'vertical') ? '' : 'link-light'}}" href="hhttps://cyberelectra.co.id/" target="_blank">Cyber Electra &trade;</a>,
      <span class="d-none d-sm-inline-block">All rights Reserved</span>
    </span>
    <span class="float-md-end d-none d-md-block">Made with<a href="https://mas-adi.net" target="_blank"><i data-feather="heart"></i></a></span>
  </p>
</footer>
@if($configData['mainLayoutType'] == 'vertical')
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
@endif
<!-- END: Footer-->
