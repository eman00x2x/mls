/** https://adnan-tech.com/backup/end-to-end-encryption-js-php-mysql#encrypt-message */

const generatedIv = generateIv();
let keyPair;

function encodeText(data) {
	if ('TextEncoder' in window) {
		return new TextEncoder('utf-8').encode(data);
	}
	return undefined;
}

function generateIv() {
	return window.crypto.getRandomValues(new Uint8Array(12));
}

async function encryptData(data, key, iv) {
	return window.crypto.subtle.encrypt({
		name: 'AES-GCM',
		iv: iv,
		tagLength: 128
	}, key, data);
}

async function generateKey() { 

	let keyPair = await window.crypto.subtle.generateKey({
			name: 'ECDH',
			namedCurve: "P-256"
		}, true, [
			'deriveKey',
			'deriveBits'
	]);

	let publicKey = await window.crypto.subtle.exportKey(
		"jwk",
		keyPair.publicKey
	);

	let privateKey = await window.crypto.subtle.exportKey(
		"jwk",
		keyPair.privateKey
	);

	return {
		"publicKey": publicKey,
		"privateKey": privateKey
	}

}
