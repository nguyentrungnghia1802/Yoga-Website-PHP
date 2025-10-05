@extends('layouts.app')
@section('content')
<div class="container">
    <div class="authors-intro">
        <h1><i class="fas fa-users"></i> Thành viên nhóm phát triển</h1>
        <p>Danh sách thành viên và nhiệm vụ chính của dự án Yoga/Gym Center.</p>
    </div>
    <div class="authors-row leader-row">
        @php $leader = $authors[0]; @endphp
        <div class="author-card horizontal">
            <div class="author-avatar">
                @php
                    $leaderImage = isset($leader['image']) && $leader['image']
                        ? asset('img/authors/' . $leader['image'])
                        : asset('img/authors/' . Str::slug($leader['name'], '') . '.jpg');
                @endphp
                <img src="{{ $leaderImage }}" alt="{{ $leader['name'] }}" class="avatar-img">
            </div>
            <div class="author-info-block">
                <div class="author-name">{{ $leader['name'] }}</div>
                <div class="author-role">{{ $leader['role'] }}</div>
                <div class="author-id">MSSV: {{ $leader['id'] }}</div>
                <div class="author-task">{{ $leader['task'] }}</div>
            </div>
        </div>
    </div>
    <div class="authors-row">
        @foreach(array_slice($authors,1,2) as $author)
        <div class="author-card horizontal">
            <div class="author-avatar">
                @php
                    $authorImage = isset($author['image']) && $author['image']
                        ? asset('img/authors/' . $author['image'])
                        : asset('img/authors/' . Str::slug($author['name'], '') . '.jpg');
                @endphp
                <img src="{{ $authorImage }}" alt="{{ $author['name'] }}" class="avatar-img">
            </div>
            <div class="author-info-block">
                <div class="author-name">{{ $author['name'] }}</div>
                <div class="author-role">{{ $author['role'] }}</div>
                @if($author['id'])<div class="author-id">MSSV: {{ $author['id'] }}</div>@endif
                <div class="author-task">{!! $author['task'] !!}</div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="authors-row">
        @foreach(array_slice($authors,3,2) as $author)
        <div class="author-card horizontal">
            <div class="author-avatar">
                @php
                    $authorImage = isset($author['image']) && $author['image']
                        ? asset('img/authors/' . $author['image'])
                        : asset('img/authors/' . Str::slug($author['name'], '') . '.jpg');
                @endphp
                <img src="{{ $authorImage }}" alt="{{ $author['name'] }}" class="avatar-img">
            </div>
            <div class="author-info-block">
                <div class="author-name">{{ $author['name'] }}</div>
                <div class="author-role">{{ $author['role'] }}</div>
                <div class="author-id">MSSV: {{ $author['id'] }}</div>
                <div class="author-task">{{ $author['task'] }}</div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="project-info">
        <h2><i class="fas fa-bullseye"></i> Về dự án Yoga/Gym Center</h2>
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
                <h3><i class="fas fa-rocket"></i> Mục tiêu dự án</h3>
                <p>{{ $project['goal'] }}</p>
            </div>
            <div class="project-detail-item">
                <h3><i class="fas fa-laptop-code"></i> Công nghệ sử dụng</h3>
                <p>Dự án được xây dựng bằng các công nghệ hiện đại:</p>
                <div class="tech-stack">
                    @foreach($project['tech'] as $tech)
                        <span class="tech-item">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            <div class="project-detail-item">
                <h3><i class="fas fa-calendar-alt"></i> Thời gian thực hiện</h3>
                <p>Dự án được triển khai trong {{ $project['period'] }}. Nhóm đã thực hiện theo phương pháp Agile, chia nhỏ các tính năng và phát triển theo từng sprint.</p>
            </div>
            <div class="project-detail-item">
                <h3><i class="fas fa-graduation-cap"></i> Bối cảnh học tập</h3>
                <p>{{ $project['context'] }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
