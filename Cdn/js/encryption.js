/** https://adnan-tech.com/backup/end-to-end-encryption-js-php-mysql#encrypt-message */

function encodeText(data) {
	if ('TextEncoder' in window) {
		return new TextEncoder('utf-8').encode(data);
	}
	return undefined;
}

function generateIv() {
	return window.crypto.getRandomValues(new Uint8Array(12));
}

async function encryptData(data, publicKey, privateKey) {
	
	const publicKeyObj = await window.crypto.subtle.importKey(
		"jwk",
		publicKey,
		{
			name: "ECDH",
			namedCurve: "P-256",
		},
		true,
		[]
	);

	const privateKeyObj = await window.crypto.subtle.importKey(
		"jwk",
		privateKey,
		{
			name: "ECDH",
			namedCurve: "P-256",
		},
		true,
		["deriveKey", "deriveBits"]
	);

	const derivedKey = await window.crypto.subtle.deriveKey(
		{ name: "ECDH", public: publicKeyObj },
		privateKeyObj,
		{ name: "AES-GCM", length: 256 },
		true,
		["encrypt", "decrypt"]
	)

	const encodedText = encodeText(data);
	const generatedIv = generateIv();
	const encryptedData = await window.crypto.subtle.encrypt(
		{ name: "AES-GCM", iv: generatedIv },
		derivedKey,
		encodedText
	);

	const uintArray = new Uint8Array(encryptedData);
	const string = String.fromCharCode.apply(null, uintArray);
	const base64Data = btoa(string);
	const b64encodedIv = btoa(new TextDecoder("utf8").decode(generatedIv))

}

async function generateKey() { 

	const keyPair = await window.crypto.subtle.generateKey({
			name: 'ECDH',
			namedCurve: "P-256"
		}, true, [
			'deriveKey',
			'deriveBits'
	]);

	const publicKey = await window.crypto.subtle.exportKey(
		"jwk",
		keyPair.publicKey
	);

	const privateKey = await window.crypto.subtle.exportKey(
		"jwk",
		keyPair.privateKey
	);

	return {
		"publicKey": publicKey,
		"privateKey": privateKey
	}

}