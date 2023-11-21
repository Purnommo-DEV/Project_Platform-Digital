@extends('Front.layout.master', ['title' => 'Syarat dan Ketentuan'])
@section('konten')
    <object data="{{ asset('Front/pdf/sk_jakilat.pdf') }}" type="application/pdf" width="100%" height="100%">
        <iframe src="{{ asset('Front/pdf/sk_jakilat.pdf') }}" width="100%" height="100%" style="border: none;">
            <p>
                Your browser does not support PDFs.
                <a href="https://example.com/test.pdf">Download the PDF</a>
                .
            </p>
        </iframe>
    </object>
@endsection
