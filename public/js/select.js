$(function () {
    $('#selectuser').select2({
        placeholder: 'Select Users',
          ajax: {
              url: '/selectuser',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.name,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});


$(function () {
    $('#selectsuplier').select2({
        placeholder: 'Select Suplier',
          ajax: {
              url: '/selectsuplier',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.nama,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});

$(function () {
    $('#selectbahanbaku').select2({
        placeholder: 'Select Bahan Baku',
          ajax: {
              url: '/selectbahanbaku',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.nama,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});


$(function () {
    $('#selectsuplier').select2({
        placeholder: 'Select Suplier',
          ajax: {
              url: '/selectsuplier',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.nama,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});



$(function () {
    $('#selectkurir').select2({
        placeholder: 'Select Kurir',
          ajax: {
              url: '/selectkurir',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.name,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});


$(function () {
    $('#selectmarketing').select2({
        placeholder: 'Select Marketing',
          ajax: {
              url: '/selectmarketing',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.name,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});


$(function () {
    $('#selectpurchasing').select2({
        placeholder: 'Select Purchasing',
          ajax: {
              url: '/selectpurchasing',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.name,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});

$(function () {
    $('#selectproduksi').select2({
        placeholder: 'Select Produksi',
          ajax: {
              url: '/selectproduksi',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.name,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});









$(function () {
    $('#selectbahanbakus').select2({
        placeholder: 'Select Bahan Baku',
          ajax: {
              url: '/selectbahanbaku',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.nama,
                              id: item.id
                          }
                      })
                  };
              },
              cache: true
          }
      });
});