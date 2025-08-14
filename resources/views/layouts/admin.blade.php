<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact">

  {{-- Head Section --}}
  @include('components.partials.admin.head')
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        {{-- Sidebar Section --}}
        @include('components.partials.admin.aside')

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar Section -->
          @include('components.partials.admin.navbar')

          <!-- Content wrapper -->
          <div class="content-wrapper" style="background: #FAFBFD;">

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- Scripts Section --}}
    @include('components.partials.admin.scripts')

    @stack('js')

  </body>
</html>
