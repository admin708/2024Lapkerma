<div class="card">
  <h5 class="card-header bg-primary p-3 text-white">Data Table</h5>
  <div class="card-body">
      <div class="d-flex flex-row-reverse bd-highlight mt-3">
          <div class="dropdown pagination_count">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Tampilkan {{ $perPage }} per Halaman
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" wire:click="setPerPage(10)">10</a></li>
                  <li><a class="dropdown-item" wire:click="setPerPage(25)">25</a></li>
                  <li><a class="dropdown-item" wire:click="setPerPage(50)">50</a></li>
                  <li><a class="dropdown-item" wire:click="setPerPage(100)">100</a></li>
              </ul>
          </div>
          <div class="dropdown order_direction px-3">
              <button class="btn btn-outline-primary" wire:click.debounce.300ms="setOrderDirection">
                  <i
                      class="menu-icon tf-icons bx {{ $orderDirection === 'asc' ? 'bx-sort-up' : 'bx-sort-down' }}"></i>
              </button>
          </div>
          <div class="dropdown jenis_kerja_sama">
              <button class="btn btn-outline-primary dropdown-toggle width" style="width: 200px;" role="button"
                  data-bs-toggle="dropdown">
                  {{ $kerjaSamaText }}
              </button>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" wire:click="setKerjasamaId(null, 'Semua Kerja Sama')">Semua Kerja Sama</a></li>
                  <li><a class="dropdown-item" wire:click="setKerjasamaId(1, 'Dalam Negeri')">Dalam Negeri</a></li>
                  <li><a class="dropdown-item" wire:click="setKerjasamaId(2, 'Luar Negeri')">Luar Negeri</a></li>
              </ul>
          </div>

          <div class="dropdown tahun_kerja_sama px-3">
              <button class="btn btn-outline-primary dropdown-toggle width" style="width: 200px;" role="button"
                  data-bs-toggle="dropdown">
                  {{ $tahunText }}
              </button>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" wire:click="setTahun(null, 'Semua Tahun')">Semua Tahun</a></li>
                  @foreach ($availableYears as $year)
                      <li><a class="dropdown-item" wire:click="setTahun({{ $year }}, '{{ $year }}')">{{ $year }}</a></li>
                  @endforeach
              </ul>
          </div>

          <div class="dropdown order_by ">
              <button class="btn btn-outline-primary dropdown-toggle" style="width: 200px;" role="button"
                  data-bs-toggle="dropdown">
                  {{ $orderByText }}
              </button>
              <ul class="dropdown-menu text-primary">
                  <li class="dropdown-item" wire:click="setOrderBy('prodi_id', 'Prodi')">PRODI</li>
                  <li class="dropdown-item" wire:click="setOrderBy('moa_reference_count', 'MoA')">MoA</li>
                  <li class="dropdown-item" wire:click="setOrderBy('ia_reference_count', 'IA')">IA</li>
                  <li class="dropdown-item" wire:click="setOrderBy('mou_reference_count', 'MoU')">MoU</li>
                  <li class="dropdown-item" wire:click="setOrderBy('total_reference_count', 'Total Kerja Sama')">TOTAL
                      KERJA SAMA</li>
              </ul>
          </div>
      </div>
      <div class="table-responsive text-nowrap mt-3">
          <table class="table table-bordered table-hover table-sm" style="font-size: 13px">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>PRODI</th>
                      <th>MoA</th>
                      <th>IA</th>
                      <th>MoU</th>
                      <th>TOTAL KERJA SAMA</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($referenceCounts as $referenceCount)
                      <tr style="font-size: 11px">
                          <td>{{ $referenceCount->prodi_id }}</td>
                          <td>{{ $referenceCount->prodi_name }}</td>
                          <td>{{ $referenceCount->moa_reference_count ?? 0 }}</td>
                          <td>{{ $referenceCount->ia_reference_count ?? 0 }}</td>
                          <td>{{ $referenceCount->mou_reference_count ?? 0 }}</td>
                          <td>{{ $referenceCount->total_reference_count ?? 0 }}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <!-- Tampilkan pagination -->
          <div class="mt-4">
              {{ $referenceCounts->links() }}
          </div>
      </div>
  </div>
</div>