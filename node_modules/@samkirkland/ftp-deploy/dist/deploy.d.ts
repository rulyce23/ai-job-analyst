import * as ftp from "basic-ftp";
import { IFileList, IFtpDeployArgumentsWithDefaults } from "./types";
import { ILogger, ITimings } from "./utilities";
export declare function getServerFiles(client: ftp.Client, logger: ILogger, timings: ITimings, args: IFtpDeployArgumentsWithDefaults): Promise<IFileList>;
export declare function deploy(args: IFtpDeployArgumentsWithDefaults, logger: ILogger, timings: ITimings): Promise<void>;
