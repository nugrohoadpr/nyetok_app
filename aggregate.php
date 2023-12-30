db.barang_masuk.aggregate([
  {
    $lookup: {
      from: 'user',
      localField: 'kode',
      foreignField: 'kode',
      as: 'datadetails',
    },
  },
  {
    $unwind: '$datadetails',
  },
]);
