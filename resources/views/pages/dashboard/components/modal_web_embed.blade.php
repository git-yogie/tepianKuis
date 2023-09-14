<div class="modal fade" id="webEmbed" tabindex="-1" aria-labelledby="form-peserta" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle">Web Embed</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Embed Kuis Anda</h4>
                    <p>Anda bisa menyematkan kuis yang sudah anda buat, ke dalam website anda dengan sedikit sentuhan!
                    </p>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        <p>Elemen HTML</p>
                        <button class="btn btn-secondary btn-sm copy-button-html"><i class="fas fa-copy"></i>
                            Salin</button>
                    </div>
                    <div class="card-body text-start">
                        <pre><code class="language-html">
&lt;div id="kuis"&gt;&lt;/div&gt;
<!-- sasdasds -->
&lt;script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"&gt;&lt;/script&gt;
&lt;script src="http://127.0.0.1:8000/library/tepian.min.js"&gt;&lt;/script&gt;

&lt;script&gt;
    var elementKuis = document.getElementById("kuis");
    var kuis = new tepianKuis(elementKuis, {
        Key: "{{ Auth::user()->api_key }}",
        quiz : "{{ $var[0]->kuis_code }}",
        title:"{{ $var[0]->nama }}"
        })
&lt;/script&gt;
                            </code></pre>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-baseline">
                            <p>Javascript</p>
                            <button class="btn btn-secondary btn-sm copy-button-javascript"
                                data-clipboard-target="#code" id="javascriptCopy"><i class="fas fa-copy"></i>
                                Salin</button>
                        </div>
                        <div class="card-body text-start">
                            <pre><code class="language-javascript">
&lt;script&gt;
    var element = document.getElementById("kuis");
    var kuis = new tepianKuis(element, {
        Key: "{{ Auth::user()->api_key }}",
        quiz : "{{ $var[0]->kuis_code }}",
        title:"{{ $var[0]->nama }}"
        })
&lt;/script&gt;
                                </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
