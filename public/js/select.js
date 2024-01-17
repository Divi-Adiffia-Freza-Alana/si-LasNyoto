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
    $('#selectpelayans').select2({
        placeholder: 'Select Pelayan',
          ajax: {
              url: '/selectpelayans',
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
    $('#selectdapurs').select2({
        placeholder: 'Select Dapur',
          ajax: {
              url: '/selectdapurs',
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
    $('#selectbagdapur').select2({
        placeholder: 'Select Bag Dapur',
          ajax: {
              url: '/selectbagdapur',
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
    $('#selectmeja').select2({
        placeholder: 'Select Meja',
          ajax: {
              url: '/selectmeja',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                  return {
                      results: $.map(data, function (item) {
                          return {
                              text: item.nomor,
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