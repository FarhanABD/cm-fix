<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="menu-item active">
    <a href="index.html" class="menu-link">
      <i class="menu-icon"><img src="{{ asset('storage/img/home.png') }}" alt="Logo" width="20px"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
  </li>

  <!-- Master data -->
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon"> <i class="menu-icon"><img src="{{ asset('storage/img/icon.svg') }}" alt="Logo" width="20px"></i></i>
      <div data-i18n="Layouts">Master Data</div>
    </a>

    <ul class="menu-sub">
      <li class="menu-item">
        <a href="layouts-without-menu.html" class="menu-link">
          <div data-i18n="Without menu">Perusahaan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="layouts-without-navbar.html" class="menu-link">
          <div data-i18n="Without navbar">Jenis Layanan</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="layouts-without-navbar.html" class="menu-link">
          <div data-i18n="Without navbar">Jenis Paket</div>
        </a>
      </li>
     
    </ul>
  </li>

  <!-- Components -->
  <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
  <!-- order -->
  <li class="menu-item">
    <a href="cards-basic.html" class="menu-link">
      <i class="menu-icon">
        <i class="menu-icon"><img src="{{ asset('storage/img/order.png') }}" alt="Logo" width="20px"></i>
      </i>
      <div data-i18n="Basic">Order</div>
    </a>
  </li>
  <!-- Invoice -->
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link">
      <i class="menu-icon"><i class="menu-icon"><img src="{{ asset('storage/img/invoice.png') }}" alt="Logo" width="20px"></i></i>
      <div data-i18n="Form Elements">Invoice</div>
    </a>
  </li>
{{-- Maintanance --}}
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link">
      <i class="menu-icon"><i class="menu-icon"><img src="{{ asset('storage/img/report.png') }}" alt="Logo" width="20px"></i></i>
      <div data-i18n="Form Elements">Report</div>
    </a>
  </li>

  <!-- Setting & Profile -->
  <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting & Profile</span></li>

  {{-- Setting --}}
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon"><i class="menu-icon"><img src="{{ asset('storage/img/settings.png') }}" alt="Logo" width="20px"></i></i>
      <div data-i18n="Layouts">Setting</div>
    </a>

    <ul class="menu-sub">
      <li class="menu-item">
        <a href="layouts-without-menu.html" class="menu-link">
          <div data-i18n="Without menu">User</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="layouts-without-navbar.html" class="menu-link">
          <div data-i18n="Without navbar">Menu</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="layouts-without-navbar.html" class="menu-link">
          <div data-i18n="Without navbar">GM</div>
        </a>
      </li>
     
    </ul>
  </li>
{{-- Logout --}}
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link">
      <i class="menu-icon"><i class="menu-icon"><img src="{{ asset('storage/img/logout.png') }}" alt="Logo" width="20px"></i></i>
      <div data-i18n="Form Elements">Logout</div>
    </a>
  </li>
  {{-- <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-box"></i>
      <div data-i18n="User interface">User interface</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="ui-accordion.html" class="menu-link">
          <div data-i18n="Accordion">Accordion</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-alerts.html" class="menu-link">
          <div data-i18n="Alerts">Alerts</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-badges.html" class="menu-link">
          <div data-i18n="Badges">Badges</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-buttons.html" class="menu-link">
          <div data-i18n="Buttons">Buttons</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-carousel.html" class="menu-link">
          <div data-i18n="Carousel">Carousel</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-collapse.html" class="menu-link">
          <div data-i18n="Collapse">Collapse</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-dropdowns.html" class="menu-link">
          <div data-i18n="Dropdowns">Dropdowns</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-footer.html" class="menu-link">
          <div data-i18n="Footer">Footer</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-list-groups.html" class="menu-link">
          <div data-i18n="List Groups">List groups</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-modals.html" class="menu-link">
          <div data-i18n="Modals">Modals</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-navbar.html" class="menu-link">
          <div data-i18n="Navbar">Navbar</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-offcanvas.html" class="menu-link">
          <div data-i18n="Offcanvas">Offcanvas</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-pagination-breadcrumbs.html" class="menu-link">
          <div data-i18n="Pagination &amp; Breadcrumbs">Pagination &amp; Breadcrumbs</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-progress.html" class="menu-link">
          <div data-i18n="Progress">Progress</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-spinners.html" class="menu-link">
          <div data-i18n="Spinners">Spinners</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-tabs-pills.html" class="menu-link">
          <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-toasts.html" class="menu-link">
          <div data-i18n="Toasts">Toasts</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-tooltips-popovers.html" class="menu-link">
          <div data-i18n="Tooltips & Popovers">Tooltips &amp; popovers</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="ui-typography.html" class="menu-link">
          <div data-i18n="Typography">Typography</div>
        </a>
      </li>
    </ul>
  </li>

  <!-- Extended components -->
  <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-copy"></i>
      <div data-i18n="Extended UI">Extended UI</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
          <div data-i18n="Perfect Scrollbar">Perfect scrollbar</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="extended-ui-text-divider.html" class="menu-link">
          <div data-i18n="Text Divider">Text Divider</div>
        </a>
      </li>
    </ul>
  </li>

  <li class="menu-item">
    <a href="icons-boxicons.html" class="menu-link">
      <i class="menu-icon tf-icons bx bx-crown"></i>
      <div data-i18n="Boxicons">Boxicons</div>
    </a>
  </li> --}}

  <!-- Forms & Tables -->
  {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Forms &amp; Tables</span></li>
  <!-- Forms -->
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-detail"></i>
      <div data-i18n="Form Elements">Form Elements</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="forms-basic-inputs.html" class="menu-link">
          <div data-i18n="Basic Inputs">Basic Inputs</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="forms-input-groups.html" class="menu-link">
          <div data-i18n="Input groups">Input groups</div>
        </a>
      </li>
    </ul>
  </li>
  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons bx bx-detail"></i>
      <div data-i18n="Form Layouts">Form Layouts</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item">
        <a href="form-layouts-vertical.html" class="menu-link">
          <div data-i18n="Vertical Form">Vertical Form</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="form-layouts-horizontal.html" class="menu-link">
          <div data-i18n="Horizontal Form">Horizontal Form</div>
        </a>
      </li>
    </ul>
  </li>
  <!-- Tables -->
  <li class="menu-item">
    <a href="tables-basic.html" class="menu-link">
      <i class="menu-icon tf-icons bx bx-table"></i>
      <div data-i18n="Tables">Tables</div>
    </a>
  </li>             --}}
</ul>