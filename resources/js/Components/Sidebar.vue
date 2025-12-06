<template>
    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">

            <!-- Brand -->
            <ul class="nav flex-column pt-3 pt-md-0">

                <li class="nav-item mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-mortarboard-fill icon icon-xs me-2" viewBox="0 0 16 16">
                                    <path
                                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                                    <path
                                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
                                </svg>
                            </span>
                            <span class="sidebar-text fw-bold">UJIAN ONLINE</span>
                        </div>

                        <span class="badge bg-secondary text-gray-800">PRO</span>
                    </div>
                </li>

                <li role="separator" class="dropdown-divider border-gray-700"></li>

                <!-- Dashboard -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/dashboard') }">
                    <Link href="/admin/dashboard" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-speedometer2 me-2"></i>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </Link>
                </li>

                <li role="separator" class="dropdown-divider mt-2 mb-2 border-gray-700"></li>

                <!-- Mata Pelajaran -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/lessons') }">
                    <Link href="/admin/lessons" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-bookmarks me-2"></i>
                        </span>
                        <span class="sidebar-text">Mata Pelajaran</span>
                    </Link>
                </li>

                <!-- Kelas -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/classrooms') }">
                    <Link href="/admin/classrooms" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-back me-2"></i>
                        </span>
                        <span class="sidebar-text">Kelas</span>
                    </Link>
                </li>

                <!-- Siswa -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/students') }">
                    <Link href="/admin/students" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-people-fill me-2"></i>
                        </span>
                        <span class="sidebar-text">Siswa</span>
                    </Link>
                </li>

                <li role="separator" class="dropdown-divider mt-2 mb-2 border-gray-700"></li>

                <!-- Ujian -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/exams') }">
                    <Link href="/admin/exams" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-pencil-square me-2"></i>
                        </span>
                        <span class="sidebar-text">Ujian</span>
                    </Link>
                </li>

                <!-- Sesi Ujian -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/exam_sessions') }">
                    <Link href="/admin/exam_sessions" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-stopwatch me-2"></i>
                        </span>
                        <span class="sidebar-text">Sesi Ujian</span>
                    </Link>
                </li>

                <li role="separator" class="dropdown-divider mt-2 mb-2 border-gray-700"></li>

                <!-- Report -->
                <li class="nav-item" :class="{ 'active': $page.url.startsWith('/admin/reports') }">
                    <Link href="/admin/reports" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <i class="bi bi-graph-up-arrow me-2"></i>
                        </span>
                        <span class="sidebar-text">Laporan Nilai</span>
                    </Link>
                </li>

            </ul>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link }
};
</script>

<style scoped>
.active {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
}
</style>
