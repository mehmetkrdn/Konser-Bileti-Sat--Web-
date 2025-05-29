package com.mehmet;

import io.restassured.response.Response;

import static org.junit.Assert.assertTrue;

import org.junit.Test;

import static io.restassured.RestAssured.*;
import static org.hamcrest.Matchers.*;

public class LoginApiEmailTest {

    @Test
    public void dogruEmailVeSifreIleGiris() {
        long baslangic = System.currentTimeMillis();

        Response yanit = given()
                .contentType("application/json")
                .body("{\"email\": \"test@example.com\", \"password\": \"12345678\"}")
        .when()
                .post("http://localhost:8000/api/login")
        .then()
                .statusCode(200)
                .body("durum", equalTo("basarili"))
                .body("mesaj", containsString("Giriş"))
                .extract().response();

        long sure = System.currentTimeMillis() - baslangic;
        System.out.println("Doğru email ve şifre ile giriş başarılı. Yanıt süresi: " + sure + " ms");

        assert sure < 1000 : "Yanıt çok yavaş geldi: " + sure + " ms";
    }

    @Test
    public void yanlisSifreIleGiris() {
        Response yanit = given()
            .contentType("application/json")
            .body("{\"email\": \"test@example.com\", \"password\": \"yanlisSifre\"}")
        .when()
            .post("http://localhost:8000/api/login")
        .then()
            .statusCode(401)
            .body("durum", equalTo("hata"))
            .body("mesaj", containsString("hatalı"))
            .extract().response();

        System.out.println("Yanlış şifre ile giriş reddedildi. Mesaj: " + yanit.path("mesaj"));
    }
@Test
public void konserlerSayfasinaGetIstegi() {
    long baslangic = System.currentTimeMillis();

    Response yanit = given()
        .when()
        .get("http://localhost:8000/konserler")
        .then()
        .statusCode(200) 
        .extract().response();

    long sure = System.currentTimeMillis() - baslangic;
    System.out.println("Konserler sayfasına GET isteği başarılı. Yanıt süresi: " + sure + " ms");

    assertTrue("Yanıt süresi 1 saniyeyi aştı!", sure < 1000);

    // İçerik kontrolü örneği (boş değil mi
    String body = yanit.getBody().asString();
    assertTrue("Yanıt içeriği boş!", body.length() > 50); 
}

}
