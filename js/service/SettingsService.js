export class SettingsService {

    async get() {
        var returnData;

        await $.get("php/Settings.php", (data) => {returnData = data});

        return returnData;
    }
}