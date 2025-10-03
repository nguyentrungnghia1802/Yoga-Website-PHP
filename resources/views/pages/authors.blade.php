@extends('layouts.app')
@section('content')
<div class="container">
    <div class="authors-intro">
        <h1>� Tác giả</h1>
        <p>Thông tin tác giả dự án Yoga/Gym Center.</p>
    </div>
    <div class="authors-row single-author-row">
        @php $author = $authors[0]; @endphp
        <div class="author-card horizontal">
            <div class="author-avatar">{{ $author['avatar'] }}</div>
            <div class="author-info-block">
                <div class="author-name">{{ $author['name'] }}</div>
                <div class="author-role">{{ $author['role'] }}</div>
                @if($author['id'])<div class="author-id">MSSV: {{ $author['id'] }}</div>@endif
                <div class="author-task">{!! $author['task'] !!}</div>
            </div>
        </div>
    </div>
    <div class="project-info">
        <h2>🎯 Về dự án Yoga/Gym Center</h2>
        <div class="project-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $project['weeks'] }}</div>
                <div class="stat-label">Tuần phát triển</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $project['features'] }}+</div>
                <div class="stat-label">Tính năng</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $project['files'] }}+</div>
                <div class="stat-label">File code</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $project['lines'] }}+</div>
                <div class="stat-label">Dòng code</div>
            </div>
        </div>
        <div class="project-details">
            <div class="project-detail-item">
                <h3>🚀 Mục tiêu dự án</h3>
                <p>{{ $project['goal'] }}</p>
            </div>
            <div class="project-detail-item">
                <h3>💻 Công nghệ sử dụng</h3>
                <p>Dự án được xây dựng bằng các công nghệ hiện đại:</p>
                <div class="tech-stack">
                    @foreach($project['tech'] as $tech)
                        <span class="tech-item">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            <div class="project-detail-item">
                <h3>📅 Thời gian thực hiện</h3>
                <p>Dự án được triển khai trong {{ $project['period'] }}. Nhóm đã thực hiện theo phương pháp Agile, chia nhỏ các tính năng và phát triển theo từng sprint.</p>
            </div>
            <div class="project-detail-item">
                <h3>🎓 Bối cảnh học tập</h3>
                <p>{{ $project['context'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
