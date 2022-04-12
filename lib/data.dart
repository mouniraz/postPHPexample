class data{
  int code;
  String message;

  data(this.code, this.message);

  factory data.fromJson(Map<String, dynamic> json) {
    return data(
      json['code'],
      json['message']
         );
  }

}