<!doctype html>
<html lang="en">
<head>
    <title>Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fbd4858647.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="container my-4">
    <h1>Detail Mahasiswa</h1>
    <div class="card my-4">
        <div class="card-header">
            <h4><i class="fas fa-user text-indigo-500" style="color: rgb(79 70 229);"></i> Data Login</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input disabled type="text" id="name" class="form-control" value="{{ $student->name }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input disabled type="text" id="email" class="form-control" value="{{ $student->user->email }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input disabled type="text" id="username" class="form-control" value="{{ $student->user->username }}">
            </div>
        </div>
    </div>
    <div class="card my-4">
        <div class="card-header">
            <h4><i class="fas fa-graduation-cap text-indigo-500" style="color: rgb(79 70 229);"></i> Data Mahasiswa</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input disabled type="text" id="nim" class="form-control" value="{{ $student->nim }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Jenis Kelamin</label>
                <input disabled type="text" id="email" class="form-control" value="{{ $student->gender == 'male' ? 'Laki-Laki':'Perempuan' }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Email</label>
                <textarea disabled class="form-control" id="address" rows="3">{{ $student->address }}</textarea>
            </div>
            <div class="mb-3">
                <label for="major" class="form-label">Jurusan</label>
                <input disabled type="text" id="major" class="form-control" value="{{ $student->major }}">
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun Masuk</label>
                <input disabled type="text" id="year" class="form-control" value="{{ $student->year }}">
            </div>
        </div>
    </div>
    <div class="card my-4">
        <div class="card-header">
            <h4><i class="fas fa-book" style="color: rgb(79 70 229);"></i> Data Pengambilan Mata Kuliah</h4>
        </div>
        <div class="row card-body">
            <table class="table table-striped">
                <thead>
                <tr class="table-dark">
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">SKS</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Nilai</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ownedCourses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->credit }}</td>
                        <td>{{ $course->pivot->semester }}</td>
                        <td>{{ $course->pivot->grade }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
