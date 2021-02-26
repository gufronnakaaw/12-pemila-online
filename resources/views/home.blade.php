<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link href="/css/dashboard/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Order</h1>

        <div class="text-right">
          <a href="/logout" onclick="return confirm('are you sure?')">Logout</a>
        </div>

        <form action="/" method="POST" class="mt-4" autocomplete="off">
          @csrf
          <input type="hidden" name="id_laptop" value="">
            <div class="form-group">
              <label>Nama Kamu</label>
              <input type="text" class="form-control @error('name_order') {{ 'is-invalid ' }} @enderror" name="name_order">
              <div class="invalid-feedback">
                @error('name_order') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="form-group">
              <label>Kelas</label>
              <select name="class" class="form-control @error('class') {{ 'is-invalid ' }} @enderror" name="class">
                <option value="">- Pilih -</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              <div class="invalid-feedback">
                @error('class') {{ $message }} @enderror
              </div>
            </div>
            
            <div class="form-group">
              <label>Jurusan</label>
              <select name="majors" class="form-control @error('majors') {{ 'is-invalid ' }} @enderror" name="majors">
                <option value="">- Pilih -</option>
                <option value="tkj">TKJ</option>
                <option value="bc">BC</option>
                <option value="kp">KP</option>
                <option value="mp">OTKP</option>
                <option value="mm">MM</option>
              </select>
              <div class="invalid-feedback">
                @error('majors') {{ $message }} @enderror
              </div>
            </div>

            <div class="form-group">
              <label>Total Laptop</label>
              <input type="number" class="form-control total-laptop @error('total') {{ 'is-invalid ' }} @enderror" name="total">
              <div class="invalid-feedback">
                @error('total') {{ $message }} @enderror
              </div>
            </div>
            
            
            <div class="form-group name_laptop"></div>
            
            <div class="form-group">
              <label>Alasan</label>
              <textarea name="reason" class="form-control reason @error('reason') {{ 'is-invalid ' }} @enderror"></textarea>
              <div class="invalid-feedback">
                @error('reason') {{ $message }} @enderror
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
    <script>

        const container = document.querySelector('.container');
        const totalLaptop = document.querySelector('.total-laptop');

        totalLaptop.addEventListener('keyup', function(){

          if( this.value === '' ){
            
            document.querySelector('.name_laptop').innerHTML = '';

          } else if( this.value > 5 ) {

            return alert('maximal 5 laptop!');

          } else {
            
            document.querySelector('.name_laptop').innerHTML = '';
            let laptops = renderLaptop(this.value);

              document.querySelector('.name_laptop').insertAdjacentHTML('beforeend', laptops);
          }

        });

        function renderLaptop(nameLoop){
          let data = {!! $laptops !!};
          let dataLaptop = ``;
          for (let i = 1; i <= nameLoop; i++) {
            dataLaptop += `<label class="mt-2">Pilih Laptop</label>`;
            dataLaptop += `<select class="form-control" name="choose_laptop_${i}" autocomplete="off">`;
            dataLaptop += `<option value="">- Pilih -</option>`;

            data.forEach(el => {
              dataLaptop += `<option value="${el.name_laptop}">${el.name_laptop}</option>`
            });

            dataLaptop += `</select>`;
          }

          return dataLaptop;
        }
    </script>
</body>
</html>