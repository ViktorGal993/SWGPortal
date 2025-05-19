const { JSDOM } = require('jsdom');
const fs = require('fs');

// HTML-Datei bekommen
const html = fs.readFileSync('./index.html', 'utf8');
const dom = new JSDOM(html);
const document = dom.window.document;

describe('SWGPortal Tests', () => {
    
    test('Logo sollte existieren', () => {
        const logo = document.querySelector('.logo a img');
        expect(logo).not.toBeNull();
        expect(logo.getAttribute('alt')).toBe('logo2');
    });

    test('Navigationsmenü sollte vorhanden sein', () => {
        const menu = document.getElementById('menu');
        expect(menu).not.toBeNull();
    });

    test('Termin-Button sollte existieren', () => {
        const terminButton = document.querySelector('.termin');
        expect(terminButton.tagName).toBe('BUTTON');
    });

    test('Support-Button sollte existieren', () => {
        const terminButton = document.querySelector('.support__button');
        expect(terminButton.tagName).toBe('BUTTON');
    });

    test('Download-Button sollte existieren', () => {
        const terminButton = document.querySelector('.button_download');
        expect(terminButton.tagName).toBe('BUTTON');
    });

     test('Bewerbung-Button sollte existieren', () => {
        const terminButton = document.querySelector('.button_bewerbung');
        expect(terminButton.tagName).toBe('BUTTON');
    });

//links testen
   describe('Link-Tests für SWGPortal', () => {
    
    test('Kontakt-Link sollte existieren und die richtige URL haben', () => {
        const kontaktLink = document.querySelector('.header-nav a[href="https://swg-datensysteme.de/kontakt/"]');
        expect(kontaktLink).not.toBeNull();
        expect(kontaktLink.getAttribute('href')).toBe('https://swg-datensysteme.de/kontakt/');
    });

    test('Kundenportal-Link sollte korrekt sein', () => {
        const portalLink = document.querySelector('.portal__button');
        expect(portalLink).not.toBeNull();
        expect(portalLink.getAttribute('href')).toBe('https://support.swg-datensysteme.de');
    });
    });

});
