<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Guru Dashboard')</title>
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .sidebar {
      transition: transform 0.3s ease-in-out;
    }
  </style>
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-gray-800 to-gray-900 p-4 md:hidden flex justify-between items-center shadow-md">
    <button class="text-white focus:outline-none" onclick="toggleSidebar()">
      <i class="fas fa-bars text-2xl"></i>
    </button>
    <div class="text-white text-xl font-semibold">Guru Dashboard</div>
  </nav>

  <!-- Sidebar -->
  <aside id="sidebar" class="sidebar bg-gray-900 text-white w-72 space-y-8 py-8 px-4 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 shadow-2xl z-50">
    <div class="text-center">
      <h2 class="text-3xl font-bold mb-2">Guru Dashboard</h2>
      <p class="text-sm text-gray-300">{{ auth()->user()->name ?? 'Guest' }}</p>
    </div>
    <nav class="space-y-4">
        <a href="{{ route('guru.dashboard') }}" class="flex items-center px-6 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('guru.dashboard') ? 'bg-blue-600' : '' }}">
            <i class="fas fa-tachometer-alt text-xl"></i>
            <span class="ml-4">Dashboard</span>
          </a>
        <a href="{{ route('guru.jadwal.index') }}" class="flex items-center px-6 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('guru.jadwal.index') ? 'bg-blue-600' : '' }}">
            <i class="fas fa-calendar-alt text-xl"></i>
            <span class="ml-4">Jadwal</span>
        </a>
        <a href="{{ route('guru.materi.index') }}" class="flex items-center px-6 py-3 rounded-lg hover:bg-gray-700 transition {{ request()->routeIs('guru.materi.index') ? 'bg-blue-600' : '' }}">
            <i class="fas fa-book text-xl"></i>
            <span class="ml-4">Materi</span>
        </a>
      <a href="{{ route('logout') }}" class="flex items-center px-6 py-3 rounded-lg hover:bg-red-600 transition"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt text-xl"></i>
        <span class="ml-4">Logout</span>
      </a>
      <!-- Form logout tersembunyi -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
    </nav>
    <div class="absolute bottom-4 left-0 right-0 text-center text-gray-400 text-xs">
      &copy; {{ date('Y') }} EduManage
    </div>
  </aside>

  <!-- Main Content -->
  <main id="main-content" class="md:ml-72 p-6 transition-all duration-300">
    @yield('content')
  </main>

  <!-- Script to toggle sidebar -->
  <script>
    function toggleSidebar() {
      let sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('-translate-x-full');
    }
  </script>
</body>
</html>
